<?php


namespace app\lib\dicionario;


class Categoria
{

    const RENDA_FIXA = 'Renda Fixa';
    const  RENDA_VARIAVEL = 'Renda Variável';

    /**
     * Retorna um enun baseado no seu valor
     *
     * @param int $modalidade valor do tipo.
     * @return string
     */
    public static function get($categoria)
    {
        $all = self::all();

        if (isset($all[$categoria])) {
            return $all[$categoria];
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
            self::RENDA_FIXA => 'Renda Fixa',
            self::RENDA_VARIAVEL => 'Renda Variável',
        ];
    }
}
