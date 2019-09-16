<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'w6L1u0fEGYsgxcr1uXmK0spFrHr0pyNT',
        ],
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
             ],
         ],
    ],
    'assetManager'=>[
                 'class'=>'yii\web\AssetManager',
                 'bundles'=>[
                 //--------
                     'insolita\wgadminlte\JsCookieAsset'=>[
                           'depends'=>[
                               'yii\web\YiiAsset',
                               'namespace\for\AdminLteAsset', // for example 'dmstr\web\AdminLteAsset', if we use https://github.com/dmstr/yii2-adminlte-asset
                          ]
                     ],
                      'insolita\wgadminlte\CollapseBoxAsset'=>[
                            'depends'=>[
                                'insolita\wgadminlte\JsCookieAsset'
                            ]
                      ],
             ],
     ]
    


    ],

];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    // $config['bootstrap'][] = 'debug';
    // $config['modules']['debug'] = [
    //     'class' => 'yii\debug\Module',
    // ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
