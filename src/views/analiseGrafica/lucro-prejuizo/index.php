<?php

use app\lib\Atributos;
use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this View */
/* @var $searchModel app\models\OperacaoSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Lucro/Prejuizo';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">

    <?= $this->render('_grafico', ['dados' => $dados]); ?>

</div>    


