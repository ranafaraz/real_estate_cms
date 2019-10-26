<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PlotOwnerInfo;
use kartik\select2\Select2;
use backend\models\Customer;
use backend\models\Property;

/* @var $this yii\web\View */
/* @var $model backend\models\PlotOwnerInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plot-owner-info-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="plot-owner-info-form">

    <?= $form->field($model,'customer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::Map(Customer::find()->all(),'customer_id','name'),
            'language' => 'en',
            'options' => ['placeholder' => '... Select a Customer to Updated ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    


    <?= $form->field($model,'property_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::Map(Property::find()->all(),'property_id','property_name'),
            'language' => 'en',
            'options' => ['placeholder' => '... Select a Property to Updated ...',],
            'pluginOptions' => [
                'allowClear' => true,
                'disabled' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'plot_no')->textInput(['readonly' => true]) ?>


    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<?PHP

$script = <<< JS

JS;
$this->registerJs($script);

?>