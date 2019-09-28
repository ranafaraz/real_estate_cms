<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Property;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Plot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plot-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
        echo $form->field($model, 'property_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Property::find()->all(), 'property_id', 'property_name'),
            'language' => 'de',
            'options' => ['placeholder' => 'Select a state ...'],
    
            'pluginOptions' => [
            'allowClear' => true
        ],
]);
    ?>
    <?= $form->field($model, 'plot_no')->textInput() ?>

    <?= $form->field($model, 'plot_length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plot_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plot_type')->dropDownList([ 'Residential' => 'Residential', 'Commercial' => 'Commercial', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'plot_price')->textInput() ?>

    <?= $form->field($model, 'per_merla_rate')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Sold' => 'Sold', 'Unsold' => 'Unsold', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
