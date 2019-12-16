<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthItem;
use backend\models\AuthAssignment;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <?=$form->field($model, 'image_name')->fileInput();?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?=$form->field($auth_model, 'item_name')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(AuthItem::find()->all(), 'name', 'name'),
    'language' => 'en',
    'options' => ['placeholder' => '<--- Select Role --->'],
    'pluginOptions' => [
        'allowClear' => true,
    ],
    ]);?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
