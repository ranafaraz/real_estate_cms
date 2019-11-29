<?php 
	namespace backend\components;
	use yii;
	use yii\base\Component;
	use backend\models\Plot;
	/**
	 * summary
	 */
	class InsertPlots Extends Component
	{
	    /**
	     * summary
	     */
	    
     public function insertplots($property_id,$no_of_plots)
    {
        $organization=\Yii::$app->user->identity->organization_id;
        $property_id=$property_id;
        (int)$no_of_plots=$no_of_plots;
      
$connection = Yii::$app->db;
        for ($i = 1; $i <= $no_of_plots; $i++) {

        	$connection->createCommand()->insert('plot',
                    [
                        'property_id' => $property_id,
                        'plot_no' => $i,
                        'plot_length'=>"",
                        'plot_width'=>"",
                        'plot_price'=>"",
                        'per_merla_rate'=>"",
                        'status'=>"Unsold",
                        'created_by'=>\Yii::$app->user->identity->username,
                        'created_at'=> date("Y-m-d"),
                        'organization_id'=>$organization,
                    ])
                    ->execute();
        	
                        
        }
       

    }
    public function insertmoreplots($property_id,$no_of_plots)
    {
        $organization=\Yii::$app->user->identity->organization_id;
        $property_id=$property_id;
        (int)$no_of_plots=$no_of_plots;
      
$connection = Yii::$app->db;
        for ($i = 1; $i <= $no_of_plots; $i++) {

            $connection->createCommand()->insert('plot',
                    [
                        'property_id' => $property_id,
                        'plot_no' => $i,
                        'plot_length'=>1,
                        'plot_width'=>1,
                        'plot_price'=>1,
                        'per_merla_rate'=>1,
                        'status'=>"Unsold",
                        'created_by'=>\Yii::$app->user->identity->username,
                        'created_at'=> date("Y-m-d"),
                        'organization_id'=>$organization,
                    ])
                    ->execute();
            
                        
        }
       

    }
	}
	
	
?>