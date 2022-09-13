<?php

namespace app\controllers;

use Yii;
use app\components\BaseController;
use app\models\Donate;

class IndexController extends BaseController
{
    public $layout = "homeLayout";

    /**
     * 显示捐赠信息搜索页面
     * 若根据donateid查询捐赠信息，
     * 并产生符合id号的二维码
     * 二维码掉调用GoogleApi
     */
    public function actionIndex()
    {
        $donateId = intval(Yii::$app->request->get("donateid", ""));
        //捐助者获取的捐书凭证上二维码包含的隐藏token信息
//        $donateToken = Yii::$app->request->get("donatetoken", "");
        //书籍上二维码包含的的隐藏信息
//        $bookToken = Yii::$app->request->get("booktoken", "");
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
        return $this->render('index', ["Dinfo" => $donateInfo, "imgsrc" => $googleQRcodesrc]);
    }
}
