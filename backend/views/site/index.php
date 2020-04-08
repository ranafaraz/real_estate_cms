<?php
    use yii\helpers\Html;
    use backend\models\Property;
    use backend\models\Plot;
    use backend\models\User;
    use backend\models\Customer;
    use backend\models\InstallmentStatus;
    use backend\models\ServicesType;
    use backend\models\ServicesDetails;
    use backend\models\ProvideServices;
    use marekpetras\yii2ajaxboxwidget\Box;

/* @var $this yii\web\View */

$this->title = 'Real Estate Management System';
?>



    
<style type="text/css">
    .info-box{
        margin: 20px auto;
    }
</style>
<?php $orgid=yii::$app->user->identity->organization_id; ?>
<div class="site-index" >
   <div class="row">
        <div class="col-md-4">
             <?php $users=User::find()->where(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?= $users ?></h3>

                  <p>Users actively Working</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a  class="small-box-footer"><br><!-- More info <i class="fa fa-arrow-circle-right"></i> --></a>
            </div>

        </div>
        <div class="col-md-4">

            <?php $property=Property::find()->where(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-green">
                <div class="inner">
                  <h3><?= $property ?></h3>

                  <p>Properties Owned</p>
                </div>
                <div class="icon">
                  <i class="fa fa-product-hunt"></i>
                </div>
                <a href="property" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <?php $plot=Plot::find()->where(['status'=>"Unsold"])->andwhere(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?= $plot ?></h3>

                    <p>Unsold Plots in All Properties</p>
                </div>
                <div class="icon">
                    <i class="fa fa-product-hunt"></i>
                </div>
                <a href="plot" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <div class="col-md-4">
            <?php $customer=Customer::find()->where(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $customer ?></h3>

                    <p>Active Customers</p>
                </div>
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <a href="customer" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">

            <?php
                $month = date('m');
                $year = date('Y');
                $sdate=$year.'-'.$month.'-'."01";
                $todate=$year.'-'.$month.'-'."31";
                $record=InstallmentStatus::find()
                ->where(['between', 'paid_date', "$sdate", "$todate" ])->andwhere(['organization_id'=>$orgid])->SUM("installment_amount");
             ?>
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php if (empty($record)) {
                        echo "0";
                        }else{ echo $record; }  ?></h3>

                    <p>Total Installment Amount this month</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
                <a href="installment-status" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
             <?php
                $month = date('m');
                $year = date('Y');
                $sdate=$year.'-'.$month.'-'."01";
                $todate=$year.'-'.$month.'-'."31";
                $received=InstallmentStatus::find()
                ->where(['between', 'paid_date', "$sdate", "$todate" ])->andwhere(['organization_id'=>$orgid])->andwhere(['status'=>'0'])->SUM("installment_amount");
             ?>
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php if (empty($received)) {
                        echo "0";
                            }else{ echo $received; }?></h3>

                    <p>Recieved Amount this month</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
                <a href="installment-status" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <?php $servicetype=ServicesType::find()->where(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $servicetype ?></h3>

                    <p>Active Services You are Providing</p>
                </div>
                <div class="icon">
                    <i class="fa fa-hand-lizard-o"></i>
                </div>
                <a href="services-type" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <?php $insdet=ServicesDetails::find()->where(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $insdet ?></h3>

                    <p>Employees Providing Services</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-o"></i>
                </div>
                <a href="services-details" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-4">
            <?php $proser=ProvideServices::find()->where(['organization_id'=>$orgid])->count(); ?>
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?= $proser ?></h3>

                    <p>Customers Being Served</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-code-o"></i>
                </div>
                <a href="provide-services" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</div>
