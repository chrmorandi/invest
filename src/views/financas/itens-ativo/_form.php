<?php

use app\models\financas\Ativo;
use kartik\number\NumberControl;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\financas\Ativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= $model->isNewRecord ? 'card-success' : 'card-info' ?> card card-outline">
    <?php $form = ActiveForm::begin(['id' => 'form_ativos_investido']); ?>
    <div class="card-body">
        <div class="ativo-form">
            <div class="row">

                <div class="col-xs-12 col-sm-5 col-lg-5">
                    <?=
                    $form->field($model, 'investidor_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(app\models\financas\Investidor::find()->asArray()->all(), 'id', 'nome'),
                        'options' => ['placeholder' => 'Selecione um Investidor'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-xs-12 col-sm-5 col-lg-5">
                    <?=
                    $form->field($model, 'ativo_id')->widget(Select2::class, [
                        'data' => Ativo::listaAtivo(),
                        'options' => ['placeholder' => 'Selecione um Investidor'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-xs-2 col-sm-2 col-lg-2">
                    <?=
                    $form->field($model, 'ativo')->widget(SwitchInput::class, [
                        'pluginOptions' => [
                            'onText' => 'Sim',
                            'offText' => 'Não',
                            'onColor' => 'success',
                            'offColor' => 'danger',
                        ]
                    ])
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-lg-3">
                    <?=
                    $form->field($model, 'quantidade')->widget(NumberControl::class, [
                        'maskedInputOptions' => [
                            'allowMinus' => false
                        ],
                        'readonly' => true, //($model->isNewRecord) ? true : false,
                    ])
                    ?>
                </div>
                <div class="col-xs-3 col-sm-3 col-lg-3">
                    <?=
                    $form->field($model, 'valor_compra')->widget(NumberControl::class, [
                        'maskedInputOptions' => [
                            'allowMinus' => false
                        ],
                        'readonly' => true, //($model->isNewRecord) ? true : false,
                    ])
                    ?>
                </div>
                <div class="col-xs-3 col-sm-3 col-lg-3">
                    <?=
                    $form->field($model, 'valor_bruto')->widget(NumberControl::class, [
                        'maskedInputOptions' => [
                            'allowMinus' => false
                        ],
                        'readonly' => true, //($model->isNewRecord) ? true : false,
                    ])
                    ?>

                </div>
                <div class="col-xs-3 col-sm-3 col-lg-3">
                    <?=
                    $form->field($model, 'valor_liquido')->widget(NumberControl::class, [
                        'maskedInputOptions' => [
                            'allowMinus' => false
                        ],
                        'readonly' => true, //($model->isNewRecord) ? true : false,
                    ])
                    ?>

                </div>

            </div>
        </div>
    </div>
    <div class="card-footer">

        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>

    </div>

    <?php ActiveForm::end(); ?>
</div>