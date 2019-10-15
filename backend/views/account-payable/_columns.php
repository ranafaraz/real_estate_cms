<?php
use yii\helpers\Url;
use dosamigos\datepicker\DatePicker;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'transaction_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'recipient_id',
        'value' => 'recipient.choice',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'amount',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'account_payable',
        'value' => 'accountPayable.account_name',
    ],
    [
        'attribute'=>'due_date',
        'format' => 'raw',
        'filter' =>DatePicker::widget([
            
         'model' => $searchModel,
         'attribute' => 'due_date',
         'template' => '{addon}{input}',
         'clientOptions' => [
             'autoclose' => true,
             'format' => 'yyyy-mm-dd',
             'disableEntry'=>true,
         ],
         'options' => [
             'pjax' => true,
         ]
     ])




        // DatePicker::widget([
        //     'model' => ,
        //     'class'=>'\kartik\grid\DataColumn',
        //     'attribute' => ,
        //     'value' => 'due_date',
        //         'clientOptions' => [
        //             'autoclose' => true,
        //             'disableEntry'=>true,
        //             'format' => 'yyyy-mm-dd'
        //         ],
        //         'options' => [
        //      'data-pjax' => '0',
        //  ]
        //     ])
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'updated_by',
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