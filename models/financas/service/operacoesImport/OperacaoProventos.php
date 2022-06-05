<?php

namespace app\models\financas\service\operacoesImport;

use Yii;
use app\lib\CajuiHelper;
use app\lib\dicionario\ProventosMovimentacao;
use app\models\financas\Operacao;
use app\models\financas\Proventos;
use app\models\financas\ItensAtivo;
use app\lib\helpers\InvestException;
use app\models\financas\OperacoesImport;
use app\models\financas\service\sincroniza\ComponenteOperacoes;


class OperacaoProventos extends OperacoesImportAbstract
{

    protected function getDados()
    {
        $filePath = Yii::getAlias('@' . OperacoesImport::DIR) . '/' . $this->operacoesImport->hash_nome . '.' . $this->operacoesImport->extensao;
        if (!file_exists($filePath)) {
            throw new InvestException("O arquivo enviado não foi salvo no servidor. ");
        }

        $this->arquivo = array_map(function ($v) use ($filePath) {
            return str_getcsv($v, ComponenteOperacoes::getFileDelimiter($filePath));
        }, file($filePath));
        unset($this->arquivo[0]);
    }

    public  function atualiza()
    {
        try {
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($this->arquivo as $id => $linha) {
                $ativoProvento = $linha[3];
                $ativoProvento = str_replace(' ', '', $ativoProvento);
                $ativoProvento = \explode('-', $ativoProvento)[0];

                $valorProvento = $linha[7];
                $valorProvento = str_replace('R$', '', $valorProvento);
                $valorProvento = str_replace('.', '', $valorProvento);
                $valorProvento = str_replace(',', '.', $valorProvento);
               

                $data  = $linha[1];
                list($d, $m, $y) = explode('/', $data);
                $data = $y . '-' . $m . '-' . ($d+1) ;

                $movimentacao = $linha[2];

                $provento = new Proventos();
                $provento->itens_ativos_id =  ItensAtivo::find()
                    ->innerJoin('ativo','itens_ativo.ativo_id = ativo.id')
                    ->where(['ativo.codigo' => $ativoProvento])
                    ->andWhere(['investidor_id' => $this->operacoesImport->investidor_id])
                    ->one()
                    ->id;
                $provento->valor = floatval($valorProvento);
                $provento->data =  $data;
                $provento->movimentacao =ProventosMovimentacao::getId($movimentacao);

                if (!$provento->save()) {
                    $erro = CajuiHelper::processaErros($provento->getErrors());
                    $transaction->rollBack();
                    throw new InvestException($erro);
                }

                $this->dadosJson['operacoes_id'][] = $provento->id;
            }
            $transaction->commit();
        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $operacoes =  json_decode($this->operacoesImport->lista_operacoes_criadas_json, true);
            if (!isset($operacoes['operacoes_id'])) {
                $this->operacoesImport->deleteUpload();
                $transaction->commit();
                return true;
            }
            foreach ($operacoes['operacoes_id'] as $operacao) {
                $objOperacao = Proventos::findOne($operacao);
                $objOperacao->delete();
            }
            $this->operacoesImport->deleteUpload();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw new InvestException("Error ao remover operação Import. ");
        }
    }
}