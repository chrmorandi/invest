<?php

use app\lib\Atributos;
use app\lib\Tempo;
use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this View */
/* @var $searchModel app\models\OperacaoSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Evolução Proventos';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">

    <?= $this->render('_grafico', ['dados' => $dados]); ?>

</div>