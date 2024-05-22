<?php

namespace app\lib\config\atualizaAtivos;

interface AtualizaAtivoInterface
{

    public function atualiza();

    public function getOperacao();

    public function setOldOperacao($oldOperacao);

    public function setTipoOperacao(string $tipoOperaco);
}
