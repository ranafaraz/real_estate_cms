<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Property;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Plot;
use backend\models\Installment;
use dosamigos\datepicker\DatePicker;
use backend\models\InstallmentStatus;
use backend\models\PlotOwnerInfo;
use backend\models\Customer;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Customers View';
$this->params['breadcrumbs'][] = $this->title;
?>
<?PHP $id = $_GET['id']?>
<?PHP 
	$customer = Customer::find()->where(['customer_id' => $id])->One();
	$prop = PlotOwnerInfo::find()->where(['customer_id' => $id])->All();
?>
<div class="row" style="margin: auto">
	<div class="col-md-12" style="text-align:center;background: white !important;margin: 0px;">
		<div class="container-fluid">
			<ul class="nav nav-tabs">
			    <li class="active"><a data-toggle="tab" href="#home">Customer</a></li>
			    <?PHP
			    foreach ($prop as  $value) {
			    	$prop_name = Property::find()->where(['property_id' => $value->property_id])->One();
			    	$plot = Plot::find()->where(['plot_no' => $value->plot_no])->One();
			    	?>

			    	 <li><a data-toggle="tab" href="#<?PHP echo $value->property_id;?>"><?PHP echo ucwords($prop_name->property_name) . ' ' . $plot->plot_no?></a></li>
			    	<?PHP
			    }
			    ?>
			   
			</ul>
		</div>
	 <div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
	      <h3>Customer Personal Info</h3>
	      <img src="<?PHP echo $customer->image ;?>" class="img-circle" style="height: 250px;width: 250px;">
	      <br>
	      <br>
	      <?= DetailView::widget([
        'model' => $customer,
        'attributes' => [
            'customerType.customer_type',
            'name',
            'father_name',
            'cnic_no',
            'contact_no',
            'email_address:email',
            'address',
            'created_date',
        ],
    ]) ?>
	      
	    </div>
	    			    <?PHP
			    foreach ($prop as  $value) {
			    	$prop_name = Property::find()->where(['property_id' => $value->property_id])->One();
			    	$plot = Plot::find()->where(['plot_no' => $value->plot_no])->One();
			    	$installment = Installment::find()->where(['customer_id' => $id])->andwhere(['property_id' => $value->property_id])->andwhere(['plot_no' => $value->plot_no])->One();
			    	$ins_sta = InstallmentStatus::find()->where(['installment_id' => $installment->installment_id])->All();
			    	?>
			<div id="<?PHP echo $value->property_id?>" class="tab-pane fade">
	      		<h3>Detail Of Property <span class="text-danger"><?PHP echo ucwords($prop_name->property_name)?></span></h3>
	      		<h4 class="text-info text-left">Plot Detail</h4>
			      <p><?= DetailView::widget([
        'model' => $plot,
        'attributes' => [
            'plot_no',
            'plot_length',
            'plot_width',
            'plot_type',
            'plot_price',
            'per_merla_rate',
            'status',
            'created_at',
        ],
    ]) ?>
    	<h4 class="text-left text-info">Payment Transactions</h4>
    	<p class="table-responsive">

    		<table class="table">
    			<tr class="bg-primary">
    				<th>Installment No.</th>
    				<th>Installment Amount</th>
    				<th>Status</th>
    				<th>Date</th>
    				<th>Due Date</th>
    			</tr>
    		<?PHP foreach($ins_sta as $value1)
    		{
    		if($value1->status == '0')
            {
                $value1->status = 'Paid';
            }
            else
            {
                $value1->status = 'Unpaid';
            }
    		?>
    		<tr class="<?PHP if($value1->status == 'Paid')
    		{
    			echo 'bg-success';
    		}else
    		{
    			echo 'bg-danger';
    		}?>">
    		<th><?PHP echo $value1->installment_no;?></th>
    		<th><?PHP echo $value1->installment_amount;?></th>
    		<th><?PHP echo $value1->status;?></th>
    		<th><?PHP echo $value1->date;?></th>
    		<th><?PHP echo $value1->paid_date;?></th>
    		<tr>
    		 <?PHP
    	}
        ?>
    			
    		</table>
 
    </p>
			</div>
			    	<?PHP
			    }
			    ?>

	    <div id="menu2" class="tab-pane fade">
	      <h3>Menu 2</h3>
	      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	    </div>
	    <div id="menu3" class="tab-pane fade">
	      <h3>Menu 3</h3>
	      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	    </div>
	  </div>
	</div>

</div>
