<?php

use app\models\TipoSearch;
use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this View */
/* @var $searchModel TipoSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Bens e Direitos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bens_direitos">
    <?= $this->render('_search', ['formBensDireitos' => $formBensDireitos]) ?>

    <?php if ($provider->count > 0) : ?>
        <?= $this->render('_grid', [
            'formBensDireitos' => $formBensDireitos,
            'provider' => $provider
        ]) ?>
    <?php endif ?>

</div>