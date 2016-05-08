<?php
namespace app\modules\apiv1;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->defaultRoute = 'index';
    }
}
