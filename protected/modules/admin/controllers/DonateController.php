<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 11:01 AM
 */
class DonateController extends Controller
{
    public $title="捐助管理";
    public $layout="//layouts/adminLayout";

    public function getViewPath()
    {
        return $this->getModule()->getViewPath();
    }

    public function actionIndex()
    {
        $this->render("donate");
    }
}