
<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    	"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" ,
        'css/site.css',
    ];
    public $js = [
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
            ];
}
