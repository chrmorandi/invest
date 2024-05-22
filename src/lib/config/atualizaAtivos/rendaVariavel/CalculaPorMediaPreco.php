<?php

namespace app\lib\config\atualizaAtivos\rendaVariavel;


use app\lib\config\atualizaAtivos\AtualizaAtivoInterface;
use app\lib\config\atualizaAtivos\RecalculaAtivosLib;
use app\lib\config\atualizaAtivos\TiposOperacoes;
use app\lib\helpers\InvestException;
use app\models\financas\Operacao;

class CalculaPorMediaPreco implements AtualizaAtivoInterface
{

    private Operacao $operacao;
    private string $tipoOperaco = '';

    public function __construct(Operacao $operacao)
    {
        $this->operacao = $operacao;
    }

    public function setTipoOperacao(string $tipoOperaco)
    {
        $this->tipoOperaco = $tipoOperaco;
    }

    public function setOldOperacao($oldOperacao)
    {

        // não  implementado;
    }

    public function getOperacao()
    {
        return $this->operacao;
    }

    public function atualiza()
    {
        $itens_ativos_id = $this->operacao->itens_ativos_id;
        if ($this->tipoOperaco === TiposOperacoes::DELETE) {
            if (!$this->operacao->delete()) {
                throw new InvestException('Erro ao deletar operação');
            }
        }
        $recalculaAtivos = new RecalculaAtivosLib($itens_ativos_id, $this);
        $recalculaAtivos->alteraIntesAtivo();
    }
}
