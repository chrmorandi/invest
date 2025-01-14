<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\MaskedInput;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\financas\Investidor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= $model->isNewRecord ? 'card-success' : 'card-info' ?> card card-outline">
    <?php $form = ActiveForm::begin(['id' => 'form_investidor']); ?>
    <div class="card-body">
        <div class="investidor-form">

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <?=
                    $form->field($model, 'cpf')->widget(MaskedInput::class, [
                        'mask' => '999.999.999-99',
                        'clientOptions' => ['removeMaskOnSubmit' => true]
                    ])
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <?= $form->field($model, 'nome')->textInput() ?>


                </div>

            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>