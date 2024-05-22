<?php

use app\lib\helpers\TipoMoeda;
use app\models\financas\ItensAtivo;
use app\models\financas\Operacao;
use kartik\datecontrol\DateControl;
use kartik\number\NumberControl;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;

/* @var $this View */
/* @var $model app\models\Operacao */
/* @var $form ActiveForm */

$valor = 'Valor';
$pais = $model->itensAtivo->ativos->pais ?? false;
$valor = TipoMoeda::valor($pais, $valor);
?>

<div class="<?= $model->isNewRecord ? 'card-success' : 'card-info' ?> card card-outline">
    <?php $form = ActiveForm::begin(['id' => 'form_operacoes']); ?>
    <div class="card-body">
        <div class="operacao-form">
            <div class="row">
                <div class="col-xs-8 col-sm-8 col-lg-8">
                    <?=
                    $form->field($model, 'itens_ativos_id')->widget(Select2::class, [
                        'data' => ItensAtivo::lista(),
                        'options' => [
                            'placeholder' => 'Selecione um Tipo',
                            'id' => 'item_ativo',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                        'pluginEvents' => [
                            "change" => 'function(data) { 
                                tipoMoeda.setMoeda();
                            }',
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-xs-4 col-lg-4 no-padding">
                    <?=
                    $form->field($model, 'tipo')->widget(Select2::class, [
                        'data' => Operacao::tipoOperacao(),
                        'options' => ['placeholder' => 'Selecione um Tipo'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>

                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-lg-4">
                    <?=
                    $form->field($model, 'quantidade')->widget(NumberControl::class, [
                        'maskedInputOptions' => [
                            'allowMinus' => false,
                            'digits' => 15,
                        ],
                    ])
                    ?>

                </div>
                <div class="col-xs-4 col-sm-4 col-lg-4">
                    <?=
                    $form->field($model, 'data')->widget(DateControl::class, [
                        'widgetOptions' => [
                            'options' => [
                                'placeholder' => 'data operação'
                            ]
                        ],
                        'type' => DateControl::FORMAT_DATETIME
                    ])
                    ?>
                </div>
                <div class="col-xs-4 col-sm-4 col-lg-4">
                    <?=
                    $form->field($model, 'valor')->widget(NumberControl::class, [
                        'maskedInputOptions' => [
                            'allowMinus' => false
                        ],
                    ])->label($valor, ['id' => 'valor'])
                    ?>

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