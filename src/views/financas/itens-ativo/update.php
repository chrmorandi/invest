<?php

/* @var $this yii\web\View */
/* @var $model app\models\financas\Ativo */

$this->title = 'Atualiza Item Ativo';
$this->params['breadcrumbs'][] = ['label' => 'Ativos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ativo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>