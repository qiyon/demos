<?php

namespace app\assets;

use yii\web\AssetBundle;

class JqueryAsset extends AssetBundle
{
    public $baseUrl = 'https://cdn.bootcdn.net/ajax/libs/jquery/2.2.3';
    public $js = [
        'jquery.min.js',
    ];
}