<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\financas\AtualizaAcao */

$this->title = 'Visualiza '. 'Atualiza Ação';
$this->params['breadcrumbs'][] = ['label' => 'Atualiza Acaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card-info card card-outline">
        <div class="card-body">
<div class="atualiza-acao-view">
    
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->ativo_id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->ativo_id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]) ?>
                <?= Html::a('Voltar',['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success', 'title' => 'Adicionar'])?>
            </p>

            <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                        'ativo_id',
            'url:ntext',
            ],
            ]) ?>

        </div>
    </div>
</div>
