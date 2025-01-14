<?php

use app\lib\config\ValorDollar;
use yii\helpers\Html;
use yii\helpers\Url;

//$skin  = (YII_ENV_DEV) ? 'navbar-lightblue' : 'navbar-success';
if (YII_ENV_TEST) {
    $skin = 'navbar-warning';
}
if (YII_ENV_DEV) {
    $skin = 'navbar-lightblue';
}
if (YII_ENV_PROD) {
    $skin = 'navbar-success';
}


$user = '';
if (!empty(Yii::$app->user->id)) {
    $user = Yii::$app->user->identity->username;
}
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-dark <?= $skin ?> navbar-expand" style="z-index: 1031;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <div class="nav-link"><b>Dollar: R$ <?= ValorDollar::getDollar() ?></b></div>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-user-lock"></i> <b>' . $user . '</b>', Url::toRoute(['site/logout']), ['class' => "nav-link"]) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>

        </li>
    </ul>
</nav>
<!-- /.navbar -->