<?php

/* @var $this \yii\web\View */
/* @var $content string */

\hail812\adminlte3\assets\AdminLteAsset::register($this);
$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$this->registerCssFile('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['fontawesome', 'icheck-bootstrap']);
?>
<?php $this->beginPage() ?>
<body class="hold-transition login-page">
<?php  $this->beginBody() ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?=Yii::$app->homeUrl?>"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
</div>
<!-- /.login-box -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>