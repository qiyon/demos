<?php
namespace app\modules\apiv1\controllers;

use yii\web\Controller;
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/15/14
 * Time: 11:17 AM
 */

class AgencyController extends Controller
{
    public function actionIndex()
    {

    }

    public function actionGetlist()
    {
        $aModel=agency::model()->findAll();

        $aArray=array();
        foreach ($aModel as $onA){
            $coodinate=$onA->coordinate;
            $coodinate=explode(',',$coodinate);

            $aArray[]=array(
                "agencyid"=>$onA->id,
                "name"=>$onA->name,
                "person"=>$onA->person,
                "address"=>$onA->address,
                "telephone"=>$onA->telephone,
                "worktime"=>$onA->worktime,
                "description"=>$onA->description,
                "longi"=>$coodinate[1],
                "lati"=>$coodinate[0],
            );
        }

        echo json_encode(array(
            "agencys"=>$aArray,
        ));
    }

    public function actionGetinfo()
    {
        $agencyId=intval(Yii::app()->request->getParam("agencyid"));
        $infoarr=agency::getAgencyInfo($agencyId);
        echo json_encode(array(
            "code"=>0,
            "info"=>$infoarr,
        ));
    }
}
