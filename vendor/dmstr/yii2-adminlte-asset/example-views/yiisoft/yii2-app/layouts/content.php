<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
 <style type="text/css">
        .panel-primary > .panel-heading{
            background-color: #00A65A !important;
    border-color:  #00A65A !important;
        }
        .panel-primary{
             border-color:  #037440 !important;
        }
        glyphicon,a{
            color: #00A65A;
        }
        a:link
        {
             color: #00A65A ;
            
        }
        a:visited{
             color: #045a32 ;
         
        }
        a:hover{
             color: #045a32;
             
        }
        a:active{
             color: #045a32 ;
     
        }
      
        a:focus{
            color: #045a32;
        }
        #crud-datatable > div > div.kv-panel-after > div.pull-left > a{
            color: white !important;
        }
    </style>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
   
    <strong>Copyright &copy; 2019 <a href="http://dexdevs.com" target="_blank">DEXDEVS</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
