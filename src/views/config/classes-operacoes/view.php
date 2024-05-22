<?php

use kartik\detail\DetailView;
use yii\helpers\Html;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model app\models\financas\ClassesOperacoes */

$this->title = 'Visualiza ' . 'ClassesOperacoes';
$this->params['breadcrumbs'][] = ['label' => 'Classes Operacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="card-info card card-outline">
    <div class="card-body">
        <div class="classes-operacoes-view">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success', 'title' => 'Adicionar']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'condensed' => true,
                'notSetIfEmpty' => true,
                'attributes' => [
                    [
                        'columns' => [
                            'id',
                            'nome',

                        ],
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>