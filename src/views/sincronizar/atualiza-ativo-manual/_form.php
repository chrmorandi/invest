<?php

use app\models\financas\ItensAtivo;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\sincronizar\AtualizaAtivoManual */
/* @var $form kartik\form\ActiveForm */
?>

<div class="card-success card card-outline">
    <div class="atualiza-ativo-manual-form">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'itens_ativo_id')->widget(Select2::class, [
                'data' => ItensAtivo::lista(),
                'options' => ['placeholder' => 'Selecione um Tipo'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

        </div>
        <div class="card-footer">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>