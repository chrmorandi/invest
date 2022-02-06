<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\financas\service\operacoesImport;

use Yii;
use app\lib\CajuiHelper;
use yii\base\UserException;
use Smalot\PdfParser\Parser;
use app\models\financas\Ativo;
use app\models\financas\Operacao;
use app\models\financas\ItensAtivo;
use app\models\financas\OperacoesImport;
use app\models\financas\service\operacoesImport\OperacoesImportHelp;
use app\models\financas\service\operacoesImport\OperacoesImportAbstract;

/**
 * Description of BancoInter
 *
 * @author henrique
 */
class OperacaoInter extends OperacoesImportAbstract
{

    private $valorCdbBruto;
    private $valorCdbLiquido;
    private $cdbBancoInterId = 40;
    private $erros;

    //put your code here
    protected function getDados()
    {
        $parser = new Parser();
        $filePath = Yii::getAlias('@' . OperacoesImport::DIR) . '/' . $this->operacoesImport->hash_nome . '.' . $this->operacoesImport->extensao;
        if (!file_exists($filePath)) {
            throw new \Exception("O arquivo envado não foi salvo no servidor. ");
        }
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();
        $valores = $this->between('TOTAL', 'POUPANÇA', $text);
        $valores = preg_replace('/[ ]{2,}|[\t]/', '@', trim($valores));
        $valores = explode('@', trim($valores));
        $this->valorCdbBruto = str_replace('.', '', $valores[count($valores) - 3]);
        $this->valorCdbBruto = str_replace(',', '.', $this->valorCdbBruto);
        $this->valorCdbLiquido = str_replace('.', '', $valores[count($valores) - 1]);
        $this->valorCdbLiquido = str_replace(',', '.', $this->valorCdbLiquido);
    }

    public function atualiza()
    {
        OperacoesImportHelp::AtualizaInter(
            [ 'cdbBancoInterId' => $this->cdbBancoInterId,
                  'valorCdbBruto' => $this->valorCdbBruto,
                  'valorCdbLiquido' => $this->valorCdbLiquido]
        );
    }

    function after($antes, $inthat)
    {
        if (!is_bool(strpos($inthat, $antes)))
            return substr($inthat, strpos($inthat, $antes) + strlen($antes));
    }

    function before($antes, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $antes));
    }

    function between($antes, $that, $inthat)
    {
        return $this->before($that, $this->after($antes, $inthat));
    }

    public function delete()
    {
        OperacoesImportHelp::delete($this->operacoesImport);
    }
}