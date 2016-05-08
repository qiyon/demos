<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Donate;

class IndexController extends Controller
{
    public $layout = "//layouts/homeLayout";

    public $title = '';

    /**
     * 显示捐赠信息搜索页面
     * 若根据donateid查询捐赠信息，
     * 并产生符合id号的二维码
     * 二维码掉调用GoogleApi
     */
    public function actionIndex()
    {
        $this->title = "捐助查询";
//        $donateId = intval(Yii::app()->request->getParam("donateid", ""));
        $donateId = '';
        //捐助者获取的捐书凭证上二维码包含的隐藏token信息
//        $donateToken = Yii::app()->request->getParam("donatetoken", "");
        $donateToken = '';
        //书籍上二维码包含的的隐藏信息
//        $bookToken = Yii::app()->request->getParam("booktoken", "");
        $donateInfo = Donate::getInfo($donateId);
        //google 二维码api
        $googleQRcodesrc = "";
        if (!empty($donateId)) {
            $chl = "http://202.115.15.3/sxadmin?r=index/index&donateid=" . $donateId;
            $chl = urlencode($chl);
            $widhtHeight = '250';
            $EC_level = "M";
            $margin = "0";
            $googleQRcodesrc .= '<img src="http://chart.apis.google.com/chart?chs=' . $widhtHeight . 'x' . $widhtHeight;
            $googleQRcodesrc .= '&cht=qr&chld=' . $EC_level . '|' . $margin . '&chl=' . $chl . '"';
            $googleQRcodesrc .= ' alt="QR code" widhtHeight="' . $widhtHeight . '" widhtHeight="' . $widhtHeight . '"/>';
        }
        $this->render('index', array("Dinfo" => $donateInfo, "imgsrc" => $googleQRcodesrc));
    }
}
