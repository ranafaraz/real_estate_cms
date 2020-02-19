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
                'users'         => 'user/index',
                //property
                'property'      =>  'property/index',
                //plot
                'plot'      =>  'plot/index',
                'search-plot' => 'plot/list',
                'update-plot'      =>  'plot/load',
                //buy plot
                'buy-plot'      =>  'buy-plot/index',
                'create-buy-plot' => 'buy-plot/create',
                'update-buy-plot' => 'buy-plot/update',
                'plot-payment' => 'buy-plot/buy-plot-payment',
                'submit-data' =>'buy-plot/submit-data',
                'plot-transactions' => 'buy-plot/plot-transactions',
                'update-data' => 'buy-plot/update-data',
                // services
                'services-type'      =>  'services-type/index',
                'services-details'      =>  'services-details/index',
                'provide-services'      =>  'provide-services/index',
                // headers

                'headers' => 'header/index',
                'header-update' => 'header/update',
                'view-header' => 'header/view',
                //customer  and installment
                'customer'      =>  'customer/index',
                'create-customer' => 'customer/create',
                'update-customer' => 'customer/update',
                'customer-info' => 'customer/view',
                'installment-payment'      =>  'installment-payment/index',
                'installment-status'      =>  'installment-status/index',
                // accounts
                'account-nature'      =>  'account-nature/index',
                'account-head'      =>  'account-head/index',
                'account-payable'      =>  'account-payable/index',
                'account-recievable'      =>  'account-recievable/index',
                'payment'  =>  'payment/index',
                'create-payment' =>'payment/create',
                'receipt'      =>  'receipt/index',

                'cust' => 'customer/check-customer',
                // transactions
                'transactions'      =>  'transactions/index',
                'create-transactions' => 'transactions/create',
                'update-transactions' => 'transactions/update',
                'income-statement'     =>'transactions/income-statement',
                'income-statement-data' => 'transactions/income-statement-data',
                'cashbook'                =>'transactions/daily-cashbook',
                'daily-cashbook-data'     =>'transactions/daily-cashbook-data',
                'daily-cashbook-data-receipt'     =>'transactions/daily-cashbook-data-receipt',
                'payable-report'    => 'transactions/payable-report',
                'account-payable-data' => 'transactions/account-payable-data',
                'recievable-report'    => 'transactions/recievable-report',
                'account-recievable-data' => 'transactions/account-recievable-data',
            ],
        ],
        
    ],
    'params' => $params,
];

