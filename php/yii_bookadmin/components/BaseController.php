<?php

namespace app\components;

use yii\web\Controller;


class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => SxAdminAuth::className()
            ]
        ];
    }
}