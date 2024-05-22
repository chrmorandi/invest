<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models\relatorios;

use yii\base\Model;

/**
 * Description of Aporte
 *
 * @author henrique
 */
class Aporte extends Model
{

    //put your code here
    public $valor;
    public $ativo;

    public function rules()
    {
        return [
            [['valor'], 'required'],
            [['valor'], 'number'],
            [['ativo'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'valor' => 'Valor Aportado',
            'ativo' => 'Remove Ativo',

        ];
    }

    public function attributeComments()
    {
        return [
            'valor' => 'Valor Aportado',
            'ativo' => 'Remove Ativo',
        ];
    }

}
