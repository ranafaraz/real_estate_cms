<?PHP
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\helpers\Html;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use backend\models\Receipt;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title = 'Record';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>

<div class="container-fluid">
  
    <ul id="clothing-nav" class="nav nav-tabs" role="tablist">
        
        <li class="nav-item">
            <a class="nav-link active" href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Receipts</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab" aria-controls="hats">Recieves</a>
        </li>

    </ul>
    <!-- Content Panel -->
    <div id="clothing-nav-content" class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="home" aria-labelledby="home-tab"> 
        <div id="ajaxCrudDatatable">
            <?=GridView::widget([
                'id'=>'crud-datatable',
                'dataProvider' => $dataProvider,

                'pjax'=>true,
                'columns' => require(__DIR__.'/_columns.php'),
                'toolbar'=> [
                    ['content'=>
                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                        ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                        '{toggleData}'.
                        '{export}'
                    ],
                ],          
                'striped' => true,
                'condensed' => true,
                'responsive' => true,          
                'panel' => [
                    'type' => 'primary', 
                    'heading' => '<i class="glyphicon glyphicon-list"></i> Receipts listing',
                    'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                    // 'after'=>BulkButtonWidget::widget([
                    //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                    //                 ["bulk-delete"] ,
                    //                 [
                    //                     "class"=>"btn btn-danger btn-xs",
                    //                     'role'=>'modal-remote-bulk',
                    //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                    //                     'data-request-method'=>'post',
                    //                     'data-confirm-title'=>'Are you sure?',
                    //                     'data-confirm-message'=>'Are you sure want to delete this item'
                    //                 ]),
                    //         ]).                        
                            '<div class="clearfix"></div>',
                ]
            ])?>
        </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="hats" aria-labelledby="hats-tab">
        <p>A hat is a head covering. It can be worn for protection against the elements, ceremonial reasons, religious reasons, safety, or as a fashion accessory.</p>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="dropdown-shoes" aria-labelledby="dropdown-shoes-tab">
        <p>A shoe is an item of footwear intended to protect and comfort the human foot while doing various activities. Shoes are also used as an item of decoration.</p>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="dropdown-boots" aria-labelledby="dropdown-boots-tab">
        <p>A boot is a type of footwear and a specific type of shoe. Most boots mainly cover the foot and the ankle, while some also cover some part of the lower calf. Some boots extend up the leg, sometimes as far as the knee or even the hip.</p>
        </div>

    </div>
</div>

<?PHP

$script = <<< js

$(document).ready(function()
{
    alert("hello");
    ('#home').show();
    })
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Initialize popover component
$(function () {
  $('[data-toggle="popover"]').popover()
})
js;
$this->registerJs($script);

?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>