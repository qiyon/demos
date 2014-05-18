<?php
class IndexController extends Controller{

    public  $layout="//layouts/homeLayout";

    /**
     * 后台主页面
     */
    public function actionIndex(){

        $this->title = "捐助查询";

        echo "hehe";
    }

    /**
     * 用于生成二维码，暂不使用
     * 现在使用的是googleApi
     */
    public function actionGetqrcode()
    {
        $donateId=intval(Yii::app()->request->getParam("donateid"));
        if (isset($donateId) && (!empty(donate::model()->findByPk($donateId))) ){
            echo $donateId;
        }

    }
}
