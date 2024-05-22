<?php

namespace app\lib\config\atualizaAtivos\rendaFixa\normais;

use app\lib\config\atualizaAtivos\rendaFixa\CalculaValorRendaFixa;
use app\lib\config\atualizaAtivos\ValorBrutoLiquidoInterface;
use app\models\financas\ItensAtivo;

class CalculaValorBrutoLiquidoFixa implements ValorBrutoLiquidoInterface
{
    public function __construct(
        private CalculaAritimetica $calculaAritimetica,
        private ItensAtivo         $itemAtivo
    )
    {
    }

    public function calcula()
    {
        $operacao = $this->calculaAritimetica->getOperacao();
        $oldOperacao = $this->calculaAritimetica->oldOperacao;
        $itemAtivo = $this->itemAtivo;

        return CalculaValorRendaFixa::calcula($operacao, $oldOperacao, $itemAtivo, $this->calculaAritimetica);
    }
}
