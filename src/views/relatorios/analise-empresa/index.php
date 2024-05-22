<?php

use app\lib\grid\GridView;
use app\models\TipoSearch;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel TipoSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Filtro Empresas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-index">

    <?= $this->render('_search', ['model' => $model]) ?>

    <?php Pjax::begin() ?>

    <?=
    GridView::widget([
        'dataProvider' => $provaider,
        'filterModel' => $searchModel,
        //  'pjax'=>true,
        'columns' => [
            'cnpj',
            'codigo',
            'nome',
            'setor',
        ],

        'toolbar' => 'padraoCajui'
    ]);
    ?>
    <?php Pjax::end() ?>

</div>