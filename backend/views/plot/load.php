<?php 
	
	use backend\models\Plot;
	use backend\models\Property;
	use yii\helpers\ArrayHelper;
	$plotno= $_GET['plotid'];
$property_id= $_GET['property_id'];
$this->title = "Showing Record For Plot No. : " .$plotno;
	?>
	<?php

$row=Plot::findOne(["plot_no"=>$plotno,"property_id"=>$property_id]);
$property=Property::findone(["property_id"=>$property_id]);
?>

<div class="row">
	<div class="col-md-8 justify-content-center col-md-offset-2" >
		<form method="post" >
	        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
	        <div class="row">
	        	<div class="col-md-4">
			        <div class="form-group">
			        	<label for="property_id">Property Name</label>
			        	 <input type="text" readonly name="property_id" value="<?php echo $property->property_name; ?>" class="form-control property" id="<?php echo $property_id; ?>" />
			        </div>
		    	</div>
		    	<div class="col-md-4">
		    		<div class="form-group">
	        			<label for="plotno">Plot No.</label>
	        			<input type="text" name="plot_no" readonly value="<?php echo $row->plot_no; ?>" class="form-control" id="plotno"  />
	        		</div>
		    	</div>
		    	<div class="col-md-4">
		    		<div class="form-group">
			        	<label for="type">Plot Type</label>
			        	<select name="plot_type" class="form-control" id="type">
			        		<option value="Residential" <?php if ($row->plot_type=="Residential") {
			        			echo "selected";
			        		} ?>>Residential</option>
			        		<option value="Commercial" <?php if ($row->plot_type=="Commercial") {
			        			echo "selected";
			        		} ?>>Commercial</option>
			        	</select>	        	
	        		</div>
		    	</div>
		    	
		    </div>
		    <div class="row">
		    	<div class="col-md-4">
		    		 <div class="form-group">
	        			<label for="length">Plot length</label>
	        			<input type="text" name="length"  value="<?php echo $row->plot_length; ?>" class="form-control" id="length"  />
	        		<div class="errorlength" style="margin:10px 0px;"></div>
	        		</div>
		    	</div>
		    	<div class="col-md-4">
		    	    <div class="form-group">
			        	<label for="width">Plot width</label>
			        	<input type="text" name="width"  value="<?php echo $row->plot_width; ?>" class="form-control" id="width" />
			        	<div class="errorwidth" style="margin:10px 0px;"></div>
			        </div>
		    	</div>
		    	<div class="col-md-4">
		    	    <div class="form-group">
			        	<label for="width">Plot Area</label>
			        	<input type="text" name="area" readonly="readonly"  value="<?php echo $row->area; ?>" class="form-control" id="area"  />
			        	<div class="errorarea" style="margin:10px 0px;"></div>
			        </div>
		    	</div>
		    	
		    	
		    </div>
		    <div class="row">
		    	<div class="col-md-4">
		    		<div class="form-group">
			        	<label for="permerla">Per Marla rate</label>
			        	<input type="text" name="permerla"   value="<?php echo $row->per_merla_rate; ?>" class="form-control" id="permerla" />
			        	<div class="errorpermerla" style="margin:10px 0px;"></div>
			        </div>
		    	</div>
		    	<div class="col-md-4">
		    		<div class="form-group">
			        	<label for="price">Plot Price</label>
			        	<input type="text" name="price"  readonly="readonly" value="<?php echo $row->plot_price; ?>" class="form-control" id="price" />
			        	<div class="errorprice" style="margin:10px 0px;"></div>
			        </div>
		    	</div>
		    	
		    	<div class="col-md-4">
		    		<div class="form-group">
			        	<label for="status">Plot Status</label>
			        	<select name="status" class="form-control" id="status">
			        		<option value="Sold" <?php if ($row->status=="'Sold") {
			        			echo "selected";
			        		} ?>>Sold</option>
			        		<option value="Unsold" <?php if ($row->status=="Unsold") {
			        			echo "selected";
			        		} ?>>Unsold</option>
			        	</select>
			        </div>
		    	</div>
		    	<div class="col-md-4">
			        	<button type="button" id="updaterecord" class="btn btn-success w-100" style="margin-top: 25px;">Update Plot </button>
		    	</div>
		    </div>
	        <div class="message_box" style="margin:10px 0px;"></div>
	        
	        </form>
	</div>
</div>
<?PHP

$script = <<< JS
	$("#permerla").on('input',function(){
		var total_price = $("#permerla").val();
		var merlas= $('#area').val();

		var permerlarate= total_price*merlas;
		permerlarate = permerlarate.toFixed(3);
		$("#price").attr('value',permerlarate);
	});
	$('#width').on('blur' , function(){

		var length = $('#length').val();
		var width = $('#width').val(); 
		var area = (length * width)/272;
		area=area.toFixed(3);
		$("#area").attr('value',area);
	});
	$('#updaterecord').click(function(e){  
		e.preventDefault();
		var length = $('#length').val();
		if(length == ''){
			$('.errorlength').html(
			'<span style="color:red;">Enter length !</span>'
			);
			$('#length').focus();
			return false;
			}else{
					$('.errorlength').html("");
				}
			var width = $('#width').val(); 
			if(width == ''){
				$('.errorwidth').html(
				'<span style="color:red;">Enter width !</span>'
				);
				$('#width').focus();
				return false;
				}else{
					$('.errorwidth').html("");
				}
				var price = $('#price').val(); 
				if(price == ''){
					$('.errorprice').html(
					'<span style="color:red;">Enter price !</span>'
					);
					$('#price').focus();
					return false;
					}else{
					$('.errorprice').html("");
				}
				var permerla = $('#permerla').val(); 
				if(permerla == ''){
					$('.errorpermerla').html(
					'<span style="color:red;">Enter per merla rate !</span>'
					);
					$('#permerla').focus();
					return false;
					}else{
						$('.errorwidth').html("");
					}
					var price = $('#price').val(); 
					if(price == ''){
						$('.errorprice').html(
						'<span style="color:red;">Enter price !</span>'
						);
						$('#price').focus();
						return false;
						}else{
						$('.errorprice').html("");
					}
					var permerla = $('#permerla').val(); 
					if(permerla == ''){
						$('.errorpermerla').html(
						'<span style="color:red;">Enter per merla rate !</span>'
						);
						$('#width').focus();
						return false;
						}else{
						$('.errorpermerla').html("");
					}
					var areaa=$('#area').val();
					var type=$("#type").val();
					var status=$("#status").val();
					var propertyid = $('.property').attr('id'); 
					var plotno = $('#plotno').val();  
					$.ajax({
						url : "./plot/updaterecord",
						method:"GET",
						data:{ length:length, width:width,areaa:areaa , price:price , permerla:permerla , type:type , status:status,propertyid:propertyid, plotno:plotno },						
							success:function(data){
								$('.message_box').html(data);
									}
						});
	});




JS;
$this->registerJs($script);
?>
