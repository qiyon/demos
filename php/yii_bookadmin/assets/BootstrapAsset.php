<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $baseUrl = 'https://stackpath.bootstrapcdn.com/bootstrap/3.4.1';
    public $css = [
        'css/bootstrap.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
    ];
}
