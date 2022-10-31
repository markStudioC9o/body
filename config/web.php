<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'language' => 'ru-RU',
  'basePath' => dirname(__DIR__),
  'controllerMap' => [
    'elfinder' => [
      'class' => 'mihaildev\elfinder\Controller',
      'access' => ['@', '?'],
      'roots' => [
        // [
        //   'baseUrl'=>'@web',
        //   'basePath'=>'@webroot',
        //   'path' => '/',
        //   'name' => 'Global'
        // ],
        [
          'path' => 'files',
          'name' => 'Файлы'
        ],
        [
          'path' => 'authors',
          'name' => 'Авторы',
        ],
        [
          'path' => 'botom-banner',
          'name' => 'Баннеры',
        ],
        [
          'path' => 'articles',
          'name' => 'Обложка статей',
        ],
        [
          'path' => 'gallery',
          'name' => 'Галерея',
        ],
      ],
      'watermark' => [
        'source'         => __DIR__ . '/logo.png', // Path to Water mark image
        'marginRight'    => 5,          // Margin right pixel
        'marginBottom'   => 5,          // Margin bottom pixel
        'quality'        => 95,         // JPEG image save quality
        'transparency'   => 70,         // Water mark image transparency ( other than PNG )
        'targetType'     => IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP | IMG_WEBP,// Target image formats ( bit-field )
        'targetMinPixel' => 200         // Target image minimum pixel size
      ]
    ]
  ],
  'bootstrap' => ['log'],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
  ],
  'modules' => [
    'admin' => [
      'class' => 'app\modules\admin\Module',
      'layout' => 'admin',
    ],
    

  ],
  'components' => [
    'request' => [
      'baseUrl' => '',
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'TqkyJ2rtkFw5lzfg_kRGDl2U0g8v92Q7',
    ],
    
    'cache' => [
      //'class' => 'yii\caching\FileCache',
      'class' => 'yii\caching\DummyCache',
    ],
    'user' => [
      'identityClass' => 'app\models\User',
      'enableAutoLogin' => true,
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],

    'shortcodes' => [
      'class' => 'tpoxa\shortcodes\Shortcode',
      'callbacks' => [
          'lastphotos' => ['app\widgets\LastPhoto', 'widget'],
          // 'anothershortcode'=>function($attrs, $content, $tag){
          // ///
          // },
          
        ],
      ],
    

    'mailer' => [
      'class' => 'yii\swiftmailer\Mailer',
      // send all mails to a file by default. You have to set
      // 'useFileTransport' to false and configure transport
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
    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
        //'admin' => 'modules/admin'
        'admin' => 'admin/default/index',
        'inside' => 'inside/index',
        'logout' => 'site/logout',
        'search' =>  'site/search',
        'def-page' => 'site/def-page',
        'apisend' => 'apisend/index',
        'pages/<index>' => 'pages/index',
        'articles/<index>' => 'articles/index',
        '<module:admin>/<controller:\w+>/<action:[0-9a-zA-Z_\-]+>' => '<module>/<controller>/<action>',
        '<lang:\w+>/articles/<index>' => 'articles/index',
        '<lang:\w+>/heading/<index>' => 'heading/index',
        '<lang:\w+>/pages/<index>' => 'pages/index',
        '<lang:\w+>' => 'site/index',
      ],
    ],
    'assetManager' => [
      'linkAssets' => true 
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
    'allowedIPs' => ['176.52.112.117', '::1'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    'allowedIPs' => ['176.52.112.117', '::1'],
  ];
}
if(YII_ENV == YII_ENV_DEV){
  unset($config['components']['cache']);
}

return $config;
