<?php
use yii\helpers\Url;
use yii\helpers\Html;
return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    //     [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'buy_plot_id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_id',
        'value' =>  'customer.name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'property_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'plot_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'plot_area',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'plot_price',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'plot_paid_price',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'plot_location',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'city',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'district',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'province',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'buy_date',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'plot_status',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'organization_id',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{pay_buy_plot} {transaction} {view} {update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
         'buttons'=>[
        'pay_buy_plot' => function ($action, $model, $key) {
            return Html::a('<i class="fa fa-money"></i>', ['./plot-payment','id'=>$model->buy_plot_id],['title'=>'Plot Payment']);
            },
        'transaction' => function ($action, $model, $key) {
            return Html::a('<i class="fa fa-exchange"></i>', ['./plot-transactions','id'=>$model->buy_plot_id],['title'=>'Plot Payment']);
            },
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   