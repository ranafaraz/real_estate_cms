<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PlotOwnerInfo;

/* @var $this yii\web\View */
/* @var $model backend\models\PlotOwnerInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plot-owner-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'property_id')->textInput() ?>

    <?= $form->field($model, 'plot_no')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'organization_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(
        ['0' => 'Select One', 'Active' => 'Active','Inactive' =>'Inactive']
    ) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?PHP
$script = <<< JS
    $('#plotownerinfo-status').on('change',function()
    {
        alert($(this).val());
        })
JS;
$this->registerJs($script);

?>