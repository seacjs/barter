<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'Dubl',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ],
    'components' => [
        'assetManager' => [
//            'linkAssets' => true,
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ]
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'cookieValidationKey' => 'YFrVNgrNvO75BBUlVu47qrWwnQKBvxDz',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@app/mail',
//            'htmlLayout' => 'layouts/html',
//            'textLayout' => 'layouts/text',
//            'messageConfig' => [
//                'charset' => 'UTF-8',
//                'from' => ['support@dubl.com' => 'Dubl'],
//            ],
            'useFileTransport' => false, // remove this on server
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'dublbarter@gmail.com',
                'password' => 'dublBarter1',
                'port' => '587', // '587', '465'
                'encryption' => 'tls', // ssl tls
            ],
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

                '/' => 'site/index',
                '/admin' => 'admin/default/index',


                /* admin */
                [
                    'pattern' => '<module>/<controller>/<action>',
                    'route' => '<module>/<controller>/<action>',
                ],
                [
                    'pattern' => '<module>/<controller>/<action>/<id:\d+>',
                    'route' => '<module>/<controller>/<action>',
                ],



                /* site */
                [
                    'pattern' => '<controller>/<action>/<id:\S+>',
                    'route' => '<controller>/<action>',
                ],
                [
                    'pattern' => '<controller>/<action>',
                    'route' => '<controller>/<action>',
                    'defaults' => [
                        'action' => 'index',
                    ],
                ],


            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*', '::1'],
    ];
}

return $config;
