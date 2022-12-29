<?php

namespace app\models\sincronizar\services\atualizaAtivos\rendaVariavel;

use app\lib\CajuiHelper;
use app\models\financas\ItensAtivo;
use app\lib\helpers\InvestException;
use app\models\sincronizar\services\atualizaAtivos\rendaVariavel\DadosAtivosValores;

class AtualizaRendaVariavel
{
    private DadosAtivosValores $dados;

    public function __construct()
    {
        $this->dados = new DadosAtivosValores();
    }

    public function alteraIntesAtivo()
    {
        $dados = $this->dados->getDados();
        foreach ($dados as $itemAtualiza) {
            $itemAtivo = ItensAtivo::findOne($itemAtualiza['itens_ativo_id']);
            $valor = $itemAtualiza['valor'];
            $itemAtivo->valor_bruto = $valor;
            $itemAtivo->valor_liquido = $valor;
            if (!$itemAtivo->save()) {
                $erro = CajuiHelper::processaErros($itemAtivo->getErrors());
                throw new InvestException($erro);
            }
        }
    }
}
