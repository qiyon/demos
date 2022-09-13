<?php

namespace app\assets\lib;

use yii\web\AssetBundle;

// https://github.com/HubSpot/messenger/tree/1.3.5/build
class MessengerAsset extends AssetBundle
{
    public $basePath = '@webroot/js/lib/messenger';
    public $baseUrl = '@web/js/lib/messenger';
    public $css = [
        'css/messenger.css',
        'css/messenger-theme-future.css',
    ];
    public $js = [
        'js/messenger.min.js',
    ];
}
