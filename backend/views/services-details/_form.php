<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\ServicesType;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicesDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'provide_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    
<?= $form->field($model, 'services_type_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(ServicesType::find()->where(['organization_id' => \Yii::$app->user->identity->organization_id])->all(),'services_type_id','services_type'),
    'language' => 'en',
    'options' => ['placeholder' => 'Select a state ...'],
    'pluginOptions' => [
        'allowClear' => true
        ],
    ]) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
