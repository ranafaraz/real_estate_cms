<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\select2\Select2;
use backend\models\Property;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Plot; 
use yii\db\Query;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plots';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="plot-index">

    <?php
        $org_id = \yii::$app->user->identity->organization_id;
        $propertymodel= new Property;
     ?>


     <?php $form = ActiveForm::begin(); ?>
     <?php
        echo $form->field($propertymodel, 'property_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Property::find()->where(["organization_id"=>$org_id])->all(), 'property_id', 'property_name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a state ...'],

            'pluginOptions' => [
            'allowClear' => true
        ],])->label(false);
    ?>

   
     <?php $form = ActiveForm::end(); ?>
     <form method="post" >
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
         <input type="hidden" name="selected_id" id="selected_id" />
         <input type="hidden" name="no_plots" id="no_plots" />
         <input type="submit" class="btn btn-success" name="search" value="Search Plots" />
     </form>
     <div class="row">
    <?php 
    $connection = \Yii::$app->db;
        if(isset($_POST['search'])){
            $selected_id=$_POST['selected_id'];
            $no_plots=$_POST['no_plots'];
            $property=Property::find()->where(['property_id'=>$selected_id])->one();
           $condition=["property_id"=>$selected_id];
            $rows=Plot::find()->where(["property_id"=>$selected_id])->all();

            ?>
        <h2 style="padding-left: 20px;">Showing Plots For Property: <span class="text-success"> <?= $property->property_name ?></span></h2>
            <?php

         foreach($rows as $plot){
            
            
        ?>
        <div class="col-md-3">
            <table class="table table-stripped bg-primary" onclick="window.open('index.php?r=plot/load&plotid=<?php echo $plot->plot_no; ?>&property_id=<?php echo $selected_id;  ?>')"   style="border-radius: 15px;text-align: center;">
                <tr>
                    <td >Plot No.</td><td><?php echo $plot->plot_no; ?></td>
                </tr>
                <tr>
                    <td>Plot Type</td><td><?php echo $plot->plot_type; ?></td>
                </tr>
                <tr>
                    <td>Plot length</td><td><?php echo $plot->plot_length; ?></td>
                </tr>
                <tr>
                    <td>Plot width</td><td><?php echo $plot->plot_width; ?></td>
                </tr>
                <tr>
                    <td>Plot Price</td><td><?php echo $plot->plot_price; ?></td>
                </tr>
            </table>
        </div>
    
    <?php }
        }
    ?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>    
<?php Modal::end(); ?>

<?php
$script=<<<JS

 $("#property-property_id").on('change',function(){
            var property_id=$(this).val();
            $("#selected_id").attr('value',property_id);
            $.get('index.php?r=property/get-property-id',{property_id:property_id},function(heads){
                var heads = $.parseJSON(heads);
                $("#no_plots").attr('value',heads.no_of_plots);
                }
            );           
        });
       
JS;
$this->registerJs($script);?>
