<?php

namespace app\components;

use Yii;
use yii\base\ActionFilter;

class SxAdminAuth extends ActionFilter
{
    protected function getRouteConfig()
    {
        return [
            'normal' => [
                '/index',
                '/admin/index/login',
                '/admin/index/logout'
            ]
        ];
    }

    public function beforeAction($action)
    {
        $actionUid = $action->getUniqueId();
        $actionPath = '/' . $actionUid;
        $routeConfig = $this->getRouteConfig();
        foreach ($routeConfig['normal'] as $normalRoute) {
            if (strpos($actionPath, $normalRoute) === 0) {
                return true;
            }
        }
        if (Yii::$app->user->identity && Yii::$app->user->identity->isadmin) {
            return true;
        } else {
            //login url
            $action->controller->redirect('/admin/index/login');
            return false;
        }
    }
}