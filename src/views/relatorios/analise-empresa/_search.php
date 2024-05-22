<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-info card card-outline">
    <div class="card-body">
        <?php
        $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]);
        ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <?=
                $form->field($model, 'id')->widget(Select2::class, [
                    //'data' => ArrayHelper::map(Categoria::find()->asArray()->all(), 'id', 'nome'),
                    'data' => app\lib\TipoFiltro::all(),
                    'options' => ['placeholder' => 'Selecione o Filtro'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('Pesquisar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-erase"></i> Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php if (!empty($model->id)) : ?>
        <div class="callout callout-info">
            <p> <?= app\lib\TipoFiltro::getDescricaoFiltro($model->id) ?></p>
        </div>
    <?php endif; ?>
</div>