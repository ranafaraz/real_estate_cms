<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthItem;
use backend\models\AuthAssignment;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Organization;


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

    <?PHP if(\Yii::$app->user->identity->organization_id == 0)
    {
        echo $form->field($model, 'organization_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Organization::find()->all(), 'id', 'name'),
    'language' => 'en',
    'options' => ['placeholder' => '<--- Select Organization --->'],
    'pluginOptions' => [
        'allowClear' => true,
        ],
        ]);
    }?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
