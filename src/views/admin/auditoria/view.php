<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\admin\Auditoria */

$this->title = 'Visualiza ' . 'Auditoria';
$this->params['breadcrumbs'][] = ['label' => 'Auditorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="box box-default">
    <div class="box-header with-border">
        <div class="auditoria-view">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'model:ntext',
                    'operacao:ntext',
                    'changes',
                    'user_id',
                    'created_at',
                ],
            ]) ?>

        </div>
    </div>
</div>