<?php

namespace app\assets;

use yii\web\AssetBundle;

class YiiJsAsset extends AssetBundle
{
    public $sourcePath = '@yii/assets';
    public $js = [
        'yii.js',
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}