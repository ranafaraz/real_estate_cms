<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="shortcut icon" href="uploads/favicon.ico" type="image/x-icon" />
        <script>
    var nameOfDay = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    var nameOfMonth = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'Desember');
    var data = new Date();
    function clock()
    {

    var hou = data.getHours();
    var min = data.getMinutes();
    var sec = data.getSeconds();
    if(hou<10){ hou= "0"+hou;}
    if(min<10){ min= "0"+min;}
    if(sec<10){ sec= "0"+sec;}

    document.getElementById('clock').innerHTML = hou+":"+min+":"+sec;
        data.setTime(data.getTime()+1000)
        setTimeout("clock();",1000);

    document.getElementById('date').innerHTML = nameOfDay[data.getDay()] + ", " + nameOfMonth[data.getMonth()] + " " + data.getDate() + ", " + data.getFullYear();
    }

    </script>
    
    </head>
    <body class="hold-transition skin-green sidebar-mini" onload="clock()">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
