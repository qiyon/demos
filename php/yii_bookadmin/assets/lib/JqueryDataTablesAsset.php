<?php

namespace app\assets\lib;

use yii\web\AssetBundle;

class JqueryDataTablesAsset extends AssetBundle
{
    public $baseUrl = 'https://cdn.datatables.net/1.10.0';
    public $css = [
        'css/jquery.dataTables.min.css',
        'css/jquery.dataTables_themeroller.min.css',
    ];
    public $js = [
        'js/jquery.dataTables.min.js',
    ];
    public $depends = [
        \app\assets\JqueryAsset::class,
    ];
}
