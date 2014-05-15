<?php
class IndexController extends Controller{

    public  $layout="//layouts/homeLayout";

    /**
     * 后台主页面
     */
    public function actionIndex(){
        $this->title = "捐助查询";

        $donateId=intval(Yii::app()->request->getParam("donateid",""));
        //捐助者获取的捐书凭证上二维码包含的隐藏token信息
        $donateToken=Yii::app()->request->getParam("donatetoken","");
        //书籍上二维码包含的的隐藏信息
        $bookToken=Yii::app()->request->getParam("booktoken","");

        $donateInfo=donate::getInfo($donateId);
        $this->render('index',array("Dinfo"=>$donateInfo));
    }
}
