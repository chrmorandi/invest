<?php

use yii\helpers\Html;
use \kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificacaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notificacaos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                 'options'   => ['style' => 'width:12%;'],
                'attribute' => 'user_id',
                'value' => function($model) {
                    if ($model->user_id == 1) {
                        return 'Sistema';
                    }
                }
            ],
            [
                'attribute' => 'dados',
                'format' => 'html',
                'value' => function($model) {
                   if($model->dados['ok']==true){
                       $estilo ='btn-success';
                   }else{
                       $estilo ='btn-danger';
                   }
                    return '<a class="btn '.$estilo.'" style="margin-bottom:4px;white-space: normal;">'.$model->dados['titulo'].'</span>';
                }
            ],
            'lido:boolean',
            [
                 'options'   => ['style' => 'width:10%;'],
                'attribute' => 'created_at',
                'label'=>'Criado em',
                'value' => function($model) {
                    return date('d/m/y H:i:s', $model->created_at);
                },
            ],
        //'updated_at',
        //['class' => 'yii\grid\ActionColumn'],
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
        //'heading' => true,
        ],
        'toolbar' => [
            [
                'content' => Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-default', 'title' => 'Limpar Filtros'])
            ],
        ],
    ]);
    ?>


</div>
