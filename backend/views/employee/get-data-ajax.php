<?php 
	use common\models\EmpSalary; 
	use common\models\Employee;
	use common\models\EmployeeTypes;
	use yii\helpers\Json;


if(isset($_POST['emp_id']) && isset($_POST['date']))
{
	$emp_id = $_POST['emp_id'];
	$date = $_POST['date'];
	$empSalaryData = Yii::$app->db->createCommand("SELECT * FROM emp_salary WHERE emp_id = '$emp_id' AND salary_month = '$date'  ORDER BY emp_salary_id DESC")->queryAll();
	$empData = Employee::find()->where(['emp_id' => $emp_id])->one();
	if(empty($empSalaryData))
	{
		echo '<tr><td colspan="8" class="text-center"><div class="col-md-12 text-danger font-weight-bold">Sorry! No Record Found!</div></td></tr>';
	}
	else
	{
		$countempSalary = count($empSalaryData);
			?>

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
			<?PHP
	}

}

?>

                    
                                   
                                    
                                