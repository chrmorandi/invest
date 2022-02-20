<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\analiseGrafica;

use app\lib\dicionario\Categoria;
use app\models\financas\Ativo;
use app\models\financas\Proventos;
use yii\base\Model;

/**
 * Description of LucroPrezuijo
 *
 * @author henrique
 */
class ProventosPorAtivos extends Model{
    const verde = '#90ed7d';
    const vermelho = '#d70026';
    
    
    public function getDadosProventos(){
        $ativos = Proventos::find()
                  ->select(['itens_ativos_id','ativo.codigo','investidor.nome','round(sum(valor)::numeric,2) as valor'])
                  ->innerjoin('itens_ativo','itens_ativo.id = proventos.itens_ativos_id')
                  ->innerjoin('ativo','ativo.id = itens_ativo.ativo_id')
                  ->innerjoin('investidor','investidor.id = itens_ativo.investidor_id')
                  ->where(['ativo'=>true])
                  ->andWhere(['categoria'=> Categoria::RENDA_VARIAVEL])
                  ->groupBy(['itens_ativos_id','ativo.codigo','investidor.nome'])
                  ->orderBy(['sum(valor)'=>SORT_DESC])
                  ->asArray()
                  ->all();
       
        return $this->criaDadosGrafico($ativos);
    }
    
    public function criaDadosGrafico($ativos){
        $dados = ['name'=>'Ativos','data'=>[]];
        foreach($ativos as $ativo){
            $ativoModel = Ativo::find()->andWhere(['codigo'=>$ativo['codigo']])->one();
            $lucro =  round(Ativo::valorCambio($ativoModel, floatval($ativo['valor'])),2);
            $cor = self::verde;
            $dados['data'][] = ['name'=>$ativo['codigo'].' | '.$ativo['nome'],'y'=>$lucro,'color'=>$cor];
        }
        
       return $dados;
    }
    
}
