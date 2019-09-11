<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'installment_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'installment_type',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'remaning_amount',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'total_amount',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'no_of_installments',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'customer_id',
        'value' => 'customer.name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'property_id',
        'value' => 'property.property_name',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   