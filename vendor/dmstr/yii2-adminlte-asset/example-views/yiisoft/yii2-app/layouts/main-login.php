<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
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
    <style type="text/css" >
    	.login-page{
    		background:url('bg1.jpg') no-repeat center center fixed; 
    		background-size: cover;
    	}
    	.login-box-body{
			background-color: #D0E5A2;
    	}
    	#loginform-username,#loginform-password{
    		border-radius: 10px;
    		background-color: #fff;
    	}
    	#loginbtn{
    		border-radius: 10px;
    	}
    </style>
</head>
<body class="login-page pull-left col-sm-offset-1"  style="">

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
