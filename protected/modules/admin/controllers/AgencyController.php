<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 14-5-18
 * Time: 下午8:15
 */

class AgencyController extends Controller
{
    public $layout="//layouts/adminLayout";

    public $title="捐赠点管理";

    public function getViewPath()
    {
        return $this->getModule()->getViewPath();
    }

    public function actionIndex()
    {
        $agenM=agency::model()->findAll();
        $this->render("agency",array("agencys"=>$agenM));
    }
}