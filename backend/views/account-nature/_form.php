<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Organization;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\AccountNature */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-nature-form">

    <?php $form = ActiveForm::begin(); ?>

  <!--   <?= $form->field($model, 'organization_id')->textInput() ?> -->
    <?php 
        echo $form->field($model, 'organization_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Organization::find()->all(), 'id', 'name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select Organization ...','id' => 'nature'],
    
            'pluginOptions' => [
            'allowClear' => true
        ],
]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?> -->

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
