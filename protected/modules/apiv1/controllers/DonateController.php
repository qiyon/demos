<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/15/14
 * Time: 10:25 AM
 */

class DonateController extends Controller
{
    public function actionIndex()
    {
        echo json_encode(array(
            'code'=>0,
        ));
    }

    public function actionGetdonateinfo()
    {
        $donateId=intval(Yii::app()->request->getParam('doanteid',0));

        echo json_encode(donate::getInfo($donateId));
    }

}