<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
Yii::setAlias('arquivos', dirname(__DIR__) . '/arquivos');

use \kartik\datecontrol\Module;
use yii\i18n\Formatter;

$config = [
    'id' => 'Invest',
    'name' => 'INVEST',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'timeZone' => 'Europe/London',
    'timeZone' => 'America/Bahia',
    'language' => 'pt-BR',
    'sourceLanguage' => 'pt-BR',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@app/lib/componentes/hail812/yii2-adminlte3/src/views'
                   // '@app/layou' => '@app/lib/componentes/hail812/yii2-adminlte3/src/views/'
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,

        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            // 'timeZone' => 'Europe/London',
            'thousandSeparator' => '.',
            //'currencyCode' => ' ',
            'decimalSeparator' => ',',
            'datetimeFormat' => 'dd/MM/yyyy HH:mm:ss',
            'dateFormat' => 'dd/MM/yyyy',
            'locale' => 'pt-BR', //your language locale
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'xxxxxxx',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession'=>true,
            'authTimeout' => (60*15),
            //'loginUrl' => ['site/login'],
            //'authTimeout' => 60 * 30,
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'modules' => [
        'gridview' => ['class' => '\kartik\grid\Module'],
        'datecontrol' => [
            
            'class' => 'kartik\datecontrol\Module',
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd/MM/yyyy',
                Module::FORMAT_TIME => 'HH:mm',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
            // set your display timezone


            // set your timezone for date saved to db

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
            // converte data entre formatos de displaySettings e saveSettings via chamada ajax.
            'ajaxConversion' => true,
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]],
                Module::FORMAT_DATETIME => [],
                Module::FORMAT_TIME => [],
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
   
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '192.168.*.*', '172.19.0.*'],
        'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'myCrud' => '@app/templates/default', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
