<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Organization;

/* @var $this yii\web\View */
/* @var $model backend\models\Header */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="header-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-6">
            <?PHP $org = Organization::find()->where(['id' => \Yii::$app->user->identity->organization_id])->One();
            $model->organization_name = $org->name; ?>
            <?= $form->field($model, 'organization_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'organization_address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'contact')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'image_name')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'logo')->fileInput() ?>
        </div>
    </div>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
