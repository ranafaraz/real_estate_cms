<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name'=>"Real Estate",
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','gii'],
    'modules' => [
        'gridview' =>  [
        'class' => '\kartik\grid\Module'
    ] ,
    
    'gii' => [
            'class' => 'yii\gii\Module',
        ],
    ],
    'components' => [
        'request' => [
            'class' => 'common\components\Request',
            'web'=> '/backend/web',
            'adminUrl' => '/admin',
            'csrfParam' => '_csrf-backend',
        ],
        'InsertPlots' => [
         
            'class' => 'backend\components\InsertPlots',

        ],
        'SaveRecord' => [
         
            'class' => 'backend\components\SaveRecord',

        ],
        'MyComponent' => [
            'class' => 'backend\components\MyComponent',

        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                
                'admin'  => 'admin',
                'user'   => 'admin/user/index',
                'login'  => 'site/login',
                'logout' => 'site/login',
                'home' => 'site/index',
                'passwords'      => 'site/passwords',
                'user-profile'   => 'site/user-profile',
                'update-profile' => 'site/update-profile',
                // organiozation
                'organization'   => 'organization/index',
                // user
                'user'         => 'user/index',
                //property
                'property'      =>  'property/index',
                //plot
                'plot'      =>  'plot/index',
                'update-plot'      =>  'plot/load',
                //buy plot
                'buy-plot'      =>  'buy-plot/index',
                'create-buy-plot' => 'buy-plot/create',
                'update-buy-plot' => 'buy-plot/update',
                // services
                'services-type'      =>  'services-type/index',
                'services-details'      =>  'services-details/index',
                'provide-services'      =>  'provide-services/index',
                //customer  and installment
                'customer'      =>  'customer/index',
                'create-customer' => 'customer/create',
                'update-customer' => 'customer/update',
                'installment-payment'      =>  'installment-payment/index',
                'installment-status'      =>  'installment-status/index',
                // accounts
                'account-nature'      =>  'account-nature/index',
                'account-head'      =>  'account-head/index',
                'account-payable'      =>  'account-payable/index',
                'account-recievable'      =>  'account-recievable/index',
                'payment'      =>  'payment/index',
                'receipt'      =>  'receipt/index',
            ],
        ],
        
    ],
    'params' => $params,
];
