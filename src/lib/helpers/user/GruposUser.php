<?php

namespace app\lib\helpers\user;

use app\models\admin\AuthItem;
use yii\helpers\ArrayHelper;

/**
 * Lista todos od grupos de permissões existentes
 * type == 1 são os papeis (grupos de permissões)
 *
 * @author Henrique Luz
 */
class GruposUser
{
    public static function listaGrupos()
    {

        return ArrayHelper::map(AuthItem::find()
            ->where(['type' => 1])->all(), 'name', 'name');
    }
}
