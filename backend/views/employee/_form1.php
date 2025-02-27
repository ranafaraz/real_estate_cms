<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\EmployeeTypes;
use common\models\Branch;
use common\models\Cities;

/* @var $this yii\web\View */
/* @var $model common\models\Employee */
/* @var $form yii\widgets\ActiveForm */
$empId = $model->emp_id;
$empName = $model->emp_name;
?>
<div class="row">
    <div class="col-md-12">
        <h2 style="text-align: center;font-family:georgia;color:#367FA9;margin-top:0px;">Update Employee (<b><?php echo $empName; ?></b>)</h2>
    </div>
</div>
<div class="employee-form" style="background-color:#efefef;padding:20px;border-top:3px solid #367FA9;">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'emp_type_id')->dropDownList(
                ArrayHelper::map(EmployeeTypes::find()->all(),'emp_type_id','emp_type_name'),
                ['prompt'=>'Select Employee Type',]
    )?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'branch_id')->dropDownList(
                ArrayHelper::map(Branch::find()->all(),'branch_id','branch_name'),
                ['prompt'=>'Select Branch',]
    )?>
        </div>
        <div class="col-md-4">
             <?= $form->field($model, 'emp_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <!-- row 1 close -->

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'emp_cnic')->widget(yii\widgets\MaskedInput::class, ['mask' => '99999-9999999-9']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_contact')->widget(yii\widgets\MaskedInput::class, [ 'mask' => '+99-999-9999999', ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_father_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <!-- row 2 close -->

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'emp_gender')->textInput([ 'value' => 'Male', 'readonly'=>true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => 'Select Status']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_driving_liscence')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <!-- row 3 close -->
    
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'salary')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'city_id')->dropDownList(
                ArrayHelper::map(Cities::find()->all(),'city_id','city_name'),
                ['prompt'=>'Select City',]
    )?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'emp_photo')->fileInput(['maxlength' => true]) ?> 
        </div>
    </div>
    <!-- row 4 close -->

    <?php if (!Yii::$app->request->isAjax){ ?>
        <div class="form-group">
            <a href="./employee-detail-view?id=<?php echo $empId;?>" class="btn btn-danger"><i class="glyphicon glyphicon-arrow-left"></i> Back</a>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : '<i class="glyphicon glyphicon-open"></i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
