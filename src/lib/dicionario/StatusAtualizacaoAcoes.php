<?php

namespace app\lib\dicionario;

class StatusAtualizacaoAcoes
{

    const PROCESSANDO = 'Processando';
    const FINALIZADO = 'Finalizado';

    /**
     * Retorna um enun baseado no seu valor
     *
     * @return string
     */
    public static function get($tipo)
    {
        $all = self::all();

        if (isset($all[$tipo])) {
            return $all[$tipo];
        }

        return 'Não existe';
    }

    /**
     * Retorna todos os enuns em um array
     *
     * @return array
     */
    public static function all()
    {
        return [
            self::PROCESSANDO => self::PROCESSANDO,
            self::FINALIZADO => self::FINALIZADO,
        ];
    }
}
