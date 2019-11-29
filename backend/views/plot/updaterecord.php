<?php 

	use yii\db\query;
?>
<?php 
			 
			

			$connection = Yii::$app->db;
			$propertyid=$_GET['propertyid'];
			$plotno=$_GET['plotno'];
			$length=$_GET['length'];
			$width=$_GET['width'];
			$area=$_GET['areaa'];
			$price=$_GET['price'];
			$permerla=$_GET['permerla'];
			$type=$_GET['type'];
			$status=$_GET['status'];  
			$query=$connection->createCommand()->Update('plot',
				[
					'plot_length'=>$length,
					'plot_width'=>$width,
					'area'=>$area,
					'plot_price'=>$price,
					'per_merla_rate'=>$permerla,
					'plot_type'=>$type,
					'status'=>$status,
				],
				[
					'plot_no'=>$plotno,
					'property_id'=>$propertyid,
				]
			)->execute();
			if($query){
				echo '<p class="font-weight-bold text-success" style="font-weight:bold;font-size:20px;">Data Updated</p>';
			}else{
				echo '<p class="font-weight-bold text-success">Something Went Wrong</p>';
			}
          
          

?>