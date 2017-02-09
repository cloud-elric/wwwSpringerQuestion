<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
		'defaultRoute'=>'modUsuarios/manager/sign-up',
		'modules' => [
				'modUsuarios' => [
						'class' => 'app\modules\ModUsuarios\ModUsuarios'
				]
		],
    'components' => [
    		'session' => [
    				'timeout'=>3600 // Segundos que durara la sesion
    		],
    		'assetManager' => [
    				'bundles' => [
    						'yii\bootstrap\BootstrapPluginAsset' => [
    								'js'=>[]
    						],
    						'yii\bootstrap\BootstrapAsset' => [
    								'css' => [],
    						],
    		
    				],
    		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KBI6OjMCowgwXJCMlZGkMY7SyGdyGb7sAB',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
       'user' => [ 
	'identityClass' => 'app\modules\ModUsuarios\models\EntUsuarios',
	'enableAutoLogin' => false,
	'authTimeout' => 3600, // Segundos que durara la sesion
	'loginUrl' => [ 
		'modUsuarios/manager/login' 
	] 
],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
       'mailer' => [ 
	'class' => 'yii\swiftmailer\Mailer',
	'transport' => [ 
		'class' => 'Swift_SmtpTransport',
		'host' => 'smtp.gmail.com', // e.g. smtp.mandrillapp.com or smtp.gmail.com
		'username' => 'humberto2geekonemonkey@gmail.com',
		'password' => '9&s3Z2L24e9^3GfXt',
		'port' => '587', // Port 25 is a very common port too
		'encryption' => 'tls' 
	] 
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [ 
	'class' => 'yii\web\UrlManager',
	// Disable index.php
	'showScriptName' => false,
	// Disable r= routes
	'enablePrettyUrl' => true,
	'enableStrictParsing' => false,
	'rules' => [
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
			
		// Estas direcciones son necesarias para el modulo			
		'cambiar-pass/<t:\w+>' => 'modUsuarios/manager/cambiar-pass',
		'peticion-pass' => 'modUsuarios/manager/peticion-pass',
		'test' => 'modUsuarios/manager/test',
		'activar-cuenta/<t:\w+>' => 'modUsuarios/manager/activar-cuenta',
		'sign-up' => 'modUsuarios/manager/sign-up',
		'login' => 'modUsuarios/manager/login',
		'callback-facebook' => 'modUsuarios/manager/callback-facebook',
		'reenviar-activacion'=>'modUsuarios/manager/reenviar-activacion'
		//'/' => 'site/index' 
	]
]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
