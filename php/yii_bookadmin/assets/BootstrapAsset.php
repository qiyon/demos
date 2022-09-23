<?php

namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $baseUrl = 'https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1';
    public $css = [
        'css/bootstrap.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
    ];
}
