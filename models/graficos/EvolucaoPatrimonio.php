<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\graficos;

use \yii\base\Model;
use \app\models\financas\Operacao;
use \yii\db\Query;
use \yii\db\Expression;
use \app\lib\Pais;

/**
 * Description of EvolucaoPatrimonio
 *
 * @author henrique
 */
class EvolucaoPatrimonio extends Model {

   
     public function getDados() { 
        
       return [$this->getPatrimonioValorMoeda(Pais::BR,'Real'),
           $this->getPatrimonioValorMoeda(Pais::US,'Dolar')];
    }
    
    public function getPatrimonioValorMoeda($pais,$moeda){
        $dados = $this->evolucaoPratrimonio($pais);
        $patromonio= ['name' => $moeda, 'data' => []];
        $valores = [];
        $datas = array_column($dados,'data_id');
        $valorPatrimonio = array_column($dados, 'valor');
       
        foreach ($valorPatrimonio as $id => $valorMes) {
            $sub = array_slice($valorPatrimonio, 0, ($id+1));
          
            $valores[] = floatval(round(array_sum($sub),2));
        }
        $patromonio['data'] =$valores;
        return $patromonio;
    }

    public function evolucaoPratrimonio($pais) {

        $comprasMes = Operacao::find()
                ->select(["to_char(data, 'YYYY-MM') as data_id", 'sum(valor) as valor_compra', 'ativo.pais'])
                ->innerJoin('ativo', 'ativo.id = operacao.ativo_id')
                ->where(['operacao.tipo' => Operacao::getTipoOperacaoId(Operacao::COMPRA)])
                ->andWhere(['ativo.pais' => $pais])
                ->andWhere(['ativo'=>true])
                ->groupBy(["to_char(data, 'YYYY-MM'),ativo.pais"]);

        $vendaMes = Operacao::find()
                ->select(["to_char(data, 'YYYY-MM') as data_id", 'sum(valor) as valor_venda', 'ativo.pais'])
                ->innerJoin('ativo', 'ativo.id = operacao.ativo_id')
                ->where(['operacao.tipo' => Operacao::getTipoOperacaoId(Operacao::VENDA)])
                ->andWhere(['ativo.pais' => $pais])
                ->andWhere(['ativo'=>true])
                ->groupBy(["to_char(data, 'YYYY-MM'),ativo.pais"]);

        $datasOperacao = Operacao::find()
                ->select(["to_char(data, 'YYYY-MM') as data_id", 'ativo.pais'])
                ->innerJoin('ativo', 'ativo.id = operacao.ativo_id')
               //  ->andWhere(['ativo.pais' => $pais])
                ->andWhere(['ativo'=>true])
                ->distinct();

        return (new Query())
                ->from(['datasOperacao' => $datasOperacao])
                ->select(['datasOperacao.data_id', '(coalesce(valor_compra, 0)  - coalesce(valor_venda, 0)) as valor'])
                ->leftJoin(['comprasMes' => $comprasMes], '"comprasMes"."data_id" = "datasOperacao"."data_id" and "datasOperacao".pais = "comprasMes"."pais"')
                ->leftJoin(['vendaMes' => $vendaMes], '"vendaMes"."data_id" = "datasOperacao"."data_id" and "datasOperacao".pais = "vendaMes"."pais"') 
                ->orderBy(['datasOperacao.data_id' => SORT_ASC])
               // ->createCommand()
              //  ->getRawSql();
        
                ->all();
    }
    
    
   

   

}
