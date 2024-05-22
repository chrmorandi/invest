<?php

use app\lib\dicionario\TipoArquivoUpload;
use app\models\financas\OperacoesImport;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\OperacoesImport */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="<?= $model->isNewRecord ? 'card-success' : 'card-info' ?> card card-outline">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card-body">

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-6">
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
            <div class="col-xs-12 col-sm-6 col-lg-6">
                <?=
                $form->field($model, 'tipo_arquivo')->widget(Select2::class, [
                    'data' => TipoArquivoUpload::all(),
                    'options' => ['placeholder' => 'Selecione um Investidor'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
                <?= $form->field($model, 'arquivo')->widget(FileInput::class, [
                    'options' => [
                        'multiple' => false,
                    ],
                    'pluginOptions' => ($model->arquivo != null) ? [
                        'initialPreview' => [
                            Url::to(['get-arquivo', 'id' => $model->id]),
                        ],
                        'initialPreviewAsData' => true,
                        //'initialPreviewFileType'=> 'image',
                        'initialCaption' => $model->arquivo,
                        'initialPreviewConfig' => [
                            [
                                'type' => isset(OperacoesImport::type_uplod_file[$model->extensao]) ? OperacoesImport::type_uplod_file[$model->extensao] : 'text',
                                'downloadUrl' => false
                            ],
                        ],
                        'overwriteInitial' => false,
                        // 'maxFileSize' => 2800
                    ] : []
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Voltar', ['index'], ['class' => 'btn btn-default']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>