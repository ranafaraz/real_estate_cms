<?php

use common\models\EmpSalary; 
use common\models\Employee;
use common\models\EmployeeTypes;
use common\models\Branch;
use common\models\Cities;

	$employeeId = $_GET['id'];
	

	$empData = Employee::find()->where(['emp_id' => $employeeId])->one();
	$branchId = $empData->branch_id;
	$cityId = $empData->city_id;
	$emptypeId = $empData->emp_type_id;

	$fetch_date = date('Y-m');
    $empSalaryData = Yii::$app->db->createCommand("SELECT * FROM emp_salary WHERE emp_id = '$employeeId' AND salary_month = '$fetch_date'  ORDER BY emp_salary_id DESC")->queryAll();
    

    $countempSalary = count($empSalaryData);

    $branchData = Branch::find()->where(['branch_id' => $branchId])->one();
    $cityData = Cities::find()->where(['city_id' => $cityId])->one();
    $emptypeData = EmployeeTypes::find()->where(['emp_type_id' => $emptypeId])->one();

    
?>

<!DOCTYPE html>
<html>
<head>
	<title>Customer Details</title>
	<style type="text/css">
		body{
			font-family:arial;
		}
		.bg-color{
			background-color:lightgray;
		}
		.t-cen{
			text-align: center;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body" style="padding:20px;">
					<div class="nav-tabs-custom">
			            <ul class="nav nav-tabs">
			              <li class="active">
			              	<a href="#employee" data-toggle="tab">Employee</a>
			              </li>
			              <li><a href="#empSalary" data-toggle="tab">Employee Salary</a></li>
			            </ul>
			            <div class="tab-content">
					            <div class="active tab-pane" id="employee">
					            	<div class="row">
					            		<div class="col-md-11">
					            			<h3 class="text-info">Employee Details</h3>
					            		</div>
					            		<div class="col-md-1">
					            			<a href="./employee-update?id=<?php echo $employeeId;?>" class="btn btn-info">
					            				<i class="glyphicon glyphicon-edit"></i> Edit
					            			</a>
					            		</div>
					            	</div>
					            	<div class="row" style="margin-bottom:10px;">
					            		<div class="col-md-12">
					            			<table class="table table-bordered">
					            				<thead style="background-color: #367FA9;color:white;">
					            					<tr>
					            						<th class="t-cen">
			            								<?php
								            				echo "Employee Name: <b style='font-size:17px; font-family:georgia;'>".$empData->emp_name."</b>";
			            				 				?>
					            						</th>
					            					</tr>
					            				</thead>
					            			</table>
					            		</div>
					            	</div>
					            	<div class="row">
					            		<div class="col-md-6">
					            			<table class="table table-bordered">
					            				<thead>
					            					<tr>
					            						<th class="text-center bg-color">Employee Type:</th>
					            						<th class="t-cen">
					            							<?php echo $emptypeData->emp_type_name; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Branch Name:</th>
					            						<th class="t-cen">
					            							<?php echo $branchData->branch_name; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee Father Name:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->emp_father_name; ?>
					            							
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee CNIC:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->emp_cnic; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee Contact No:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->emp_contact; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee City:</th>
					            						<th class="t-cen">
					            							<?php echo $cityData->city_name; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee Salary:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->salary; ?>
					            						</th>
					            					</tr>
					            				</thead>
					            			</table>
					            		</div>
					            		<div class="col-md-6">
					            			<table class="table table-bordered">
					            				<thead>
					            					<tr>
					            						<th class="text-center bg-color">Employee Gender:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->emp_gender; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee Status:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->emp_status; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color">Employee Driving Liscence:</th>
					            						<th class="t-cen">
					            							<?php echo $empData->emp_driving_liscence; ?>
					            						</th>
					            					</tr>
					            					<tr>
					            						<th class="text-center bg-color" style="vertical-align:middle;">Employee Image:</th>
					            						<th class="text-center">
					            							<img src="<?php echo $empData->emp_photo; ?>" class="img-rounded" alt="Image" style="width:150px; height:135px;"/>
					            						</th>
					            					</tr>
					            				</thead>
					            			</table>
					            		</div>
					            	</div>  
					            </div>
					              <!-- /.tab-pane -->
					            <div class="tab-pane" id="empSalary">
					              	<div class="row">
					            		<div class="col-md-5">
					            			<h3 class="text-info">Employee Salary Details</h3>
					            		</div>
					            		<div class="col-md-7 text-right">
					            			<label for="month w-100 float-right">Enter Salary Month to View
            								<input type="month" id="month"  name="salary_month" class="form-control form input w-100"></label>
            								<button class="btn btn-info" id="search">Search</button>

            								<a href="./emp-salary-create?id=<?php echo $employeeId;?>" class="btn btn-success float-right"><i class="glyphicon glyphicon-plus"></i> Insert
					            			</a>
					            			<button style="float: right;margin-top:20px;margin-left: 10px;" onclick="printContent('std-report')" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Print
											</button>

					            			<span class="d-none employee" id="<?PHP echo $employeeId;?>" ></span>
					            		</div>

					            	</div>

					            	<div class="row" id="std-report">

										<div class="col-md-12" style="height: 90px">
											<table class="table">
												<tr>
													<td>
														<img src="images/aats_logo.jpeg" height="70" width="70" class="img-circle">
													</td>
													<td>
														<h1 style="font-size:25px; margin-top: 5px ; margin-left: 60px; font-family: Arial">
															آزاد اعوان ٹریلرسروس پرائیویٹ لمیٹد  <br> 
															<span style="font-size: 16px; margin-left: 80px">چوک بہادر پور | رحیم یار خان</span>
														</h1>
													</td>
												</tr>
											</table>
										</div>
					            		<div class="col-md-12">
					            			<div class="table-responsive" >           			
					            			<table class="table table-bordered table-striped">
					            				<thead style="background-color: #367FA9;color:white;">
					            					<tr>
					            						
					            						
					            						
					            							
					            							
					            						
					            						<th class="t-cen">حالت</th>
					            						<th class="t-cen">تنخواہ کا مہینہ</th>
					            						<th class="t-cen">بقایا رقم</th>
					            						<th class="t-cen">تاریخ</th>
					            						<th class="t-cen">ادا شدہ رقم</th>
					            						<th class="t-cen">ملازم کا نام</th>
					            						<th class="t-cen">نمبر شمار</th>
					            				<!-- 		<th class="t-cen">Action</th> -->
					            					</tr>

					            				</thead>
					            				<tbody id="tablebody">
					            					<?php 
					            						$total_paid_sum =0;
					            						$total_remaining_sum =0;
					            						for ($i=0; $i <$countempSalary ; $i++) {
					            							$total_paid_sum = $total_paid_sum + $empSalaryData[$i]['paid_amount'];
					            							$total_remaining_sum = $total_remaining_sum + $empSalaryData[$i]['remaining'];
					            							?>
					            							
					            						<tr>
					            							<td><?php echo $empSalaryData[$i]['status']; ?></td>
					            							<td><?php echo date('F-Y',strtotime($empSalaryData[$i]["salary_month"])); ?></td>
					            							<td><?php echo $empSalaryData[$i]['remaining']; ?></td>
					            							<td><?php echo $empSalaryData[$i]['date']; ?></td>
					            							<td><?php echo $empSalaryData[$i]['paid_amount']; ?></td>
					            							<td><?php echo $empData->emp_name; ?></td>
					            							<td><?php echo $i+1; ?></td>
					            						<!-- 	<td class="text-center"><a href="emp-salary-update?id=<?php echo $empSalaryData[$i]['emp_salary_id'] ?>" class="fa fa-edit label label-info" title="Edit"> Edit</a></td> -->
					            						</tr>	
					            					
					            					<?php } ?>
					            					<tr class="bg-success">
					            						<th colspan="5" class="text-right"><?PHP echo $total_paid_sum;?></th>
					            						<th colspan="2">کل ادائیگی</th>
					            					</tr>
					            				</tbody>
					            			</table>
					            			</div>
					            		</div>

					            	</div>
					            </div>
					              <!-- /.tab-pane -->
			            </div>
			            <!-- /.tab-content -->
          			</div>
          			<!-- /.nav-tabs-custom -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- container close -->
</body>
</html>

<?PHP
$script = <<< JS
	$('#search').on('click',function()
	{
		var date = $('#month').val();
		var emp_id = $('.employee').attr('id');
		$.ajax({
			type : 'POST',
			url : 'get-data-ajax',
			data : {emp_id:emp_id,date:date},
			success:function(data)
			{
				$('#tablebody').html(data);
			}

		})
	})


JS;
$this->registerJs($script);


?>
<script type="text/javascript">
	function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
	return window.location.reload(true);
}
</script>