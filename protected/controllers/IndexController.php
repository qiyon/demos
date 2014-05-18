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


        //google 二维码api
        $googleQRcodesrc="";
        if ( !empty($donateId) ){
            $chl="http://202.115.15.3/sxadmin?r=index/index&donateid=".$donateId;
            $chl=urlencode($chl);
            $widhtHeight='250';
            $EC_level="M";
            $margin="0";
            $googleQRcodesrc=  '<img src="http://chart.apis.google.com/chart?chs='.
                    $widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.
                    '&chl='.$chl.'" alt="QR code" widhtHeight="'.
                    $widhtHeight.'" widhtHeight="'.$widhtHeight.'"/>';
        }
        $this->render('index',array("Dinfo"=>$donateInfo,"imgsrc"=>$googleQRcodesrc));
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
