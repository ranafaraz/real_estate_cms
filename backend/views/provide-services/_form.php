<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Customer;
use backend\models\ServicesType;

/* @var $this yii\web\View */
/* @var $model backend\models\ProvideServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provide-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Customer::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->all(),'customer_id','name'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
            ],
        ]) 
    ?>

    <?= $form->field($model, 'services_type_id')->dropDownList(
        ArrayHelper::map(ServicesType::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->all(),'services_type_id','services_type'),
        [
            'prompt' => 'Select Service Type',
            'onchange' => '$.post("index.php?r=services-details/list&id='.'"+$(this).val(),function(data){
                $("#provideservices-services_id").html(data);
            });'
        ]

    )
    ?>

    <?= $form->field($model, 'services_id')->widget(Select2::classname(), [
    'language' => 'en',
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
            ],
        ]) 
    ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
