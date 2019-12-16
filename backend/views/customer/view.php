<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use backend\models\Customer;
/* @var $this yii\web\View */
/* @var $model backend\models\Customer */

$image = Customer::find()->where(['customer_id'=>$model->customer_id])->one();
?>

<div class="customer-view">
    <center>
        <figure>
            <img src="<?php echo $image->image ?>" alt="customer image" width="300" height="300" />
            <!-- <figcaption>(Click to enlarge)</figcaption> -->
        </figure>    
    </center>
    <br>
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'customer_id',
            'customer_type_id',
            'name',
            'father_name',
            'cnic_no',
            'contact_no',
            'email_address:email',
            'address',
            'user_id',
            'organization_id',
            'created_date',
        ],
    ]) ?>

</div>
