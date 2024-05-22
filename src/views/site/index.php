<?php
/* @var $this yii\web\View */

$this->title = 'Patrimônio';

?>

<div class="row">
    <div class="col-lg-3">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/patrimonio_categoria', ['dadosCategoria' => $dadosCategoria]) ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/patrimonio_tipo', ['dadosTipo' => $dadosTipo]) ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/patrimonio_pais', ['dadosPais' => $dadosPais]) ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/acoes_pais', ['dadosAcoesPais' => $dadosAcoesPais]) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-green"><i class="fa fa-dollar-sign "></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Valor Invest.</span>
                <span class="info-box-number"> <?= $patrimonioBruto ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-blue"><i class="fa fa-briefcase "></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Total Aportes</span>
                <span class="info-box-number"><?= $valorCompra ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-yellow"><i class="fa fa-hand-holding-usd"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Lucro Bruto</span>
                <span class="info-box-number"><?= $lucro_bruto ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="info-box">
            <!-- Apply any bg-* class to to the icon to color it -->
            <span class="info-box-icon bg-olive"><i class="fa fa-arrow-down"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Proventos</span>
                <span class="info-box-number"><?= $proventos ?></span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
    </div>
</div>
<div class="row ">
    <div class="col-lg-12">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/ativos_detalhados', ['dadosAtivo' => $dadosAtivo]) ?>
        </div>
    </div>

</div>
<div class="row ">
    <div class="col-lg-6">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/acoes_totais', ['dadosAcoes' => $dadosAcoes]) ?>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-info card card-outline">
            <?= $this->render('@app/views/site/graficos/fiis_totais', ['dadosFiis' => $dadosFiis]) ?>
        </div>
    </div>

</div>

