<?php

namespace app\assets\lib;

use yii\web\AssetBundle;

// https://github.com/HubSpot/messenger/tree/1.3.5/build
class MessengerAsset extends AssetBundle
{
    public $baseUrl = 'https://cdn.bootcdn.net/ajax/libs/messenger/1.3.5';
    public $css = [
        'css/messenger.css',
        'css/messenger-theme-future.css',
    ];
    public $js = [
        'js/messenger.min.js',
    ];
}
