<?php

use miloschuman\highcharts\Highcharts;

?>


<?=
Highcharts::widget([
    'id' => 'grafico-pizza-categoria',
    'scripts' => [
        'modules/exporting',
    ],
    'options' => [
        'chart' => [
            'type' => 'pie',
            'height' => 350,
        ],
        'title' => [
            'text' => 'Categoria',
        ],
        'series' => [
            [
                'name' => 'Categorias',
                'data' => $dadosCategoria,
                //'size' => 200,
                'showInLegend' => false,
                'dataLabels' => [
                    'enabled' => false,
                    'format' => '<span style="font-size:13px">{point.name}: {point.y:f} %'
                ],
                'depth' => 100,
                'tooltip' => [
                    'headerFormat' => '',
                    'pointFormat' => '<span >{point.name}</span>: <b>{point.y:f} %</b> do Patrimônio<br/>'
                ],
            ],
        ],
    ]
])
?>


