<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'customer_id',
            [
                'attribute' => 'customer_type_id',
                'value'=> 'customerType.customer_type',
            ],
            
            'name',
            'father_name',
            'cnic_no',
            //'contact_no',
            //'email_address:email',
            //'address',
            //'user_id',
            //'organization_id',
            //'created_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
