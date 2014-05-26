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

    /**
     * 读取捐赠点信息并传送到view视图显示
     */
    public function actionIndex()
    {
        $agenM=agency::model()->findAll();
        $this->render("agency",array("agencys"=>$agenM));
    }

    public function actionGetinfo()
    {
        $agencyId=intval(Yii::app()->request->getParam("agencyid"));
        $info=agency::getAgencyInfo($agencyId);

        echo json_encode(array(
            "code"=>0,
            "info"=>$info,
        ));
    }

    public function actionEdit()
    {
        if (isset($_POST["agencyid"])){
            $resV=agency::agencyAddOrChange($_POST);
        }

        if (!empty($resV)){
            echo json_encode(array(
                "code"=>0
            ));
        }else{
            echo json_encode(array(
                "code"=>-1,
                "message"=>"修改失败"
            ));
        }
    }
    public function actionDelete()
    {
        $agencyid=intval(Yii::app()->request->getParam("agencyid"));
        $donate_count=donate::model()->count("agencyid=:aid",array(":aid"=>$agencyid));
        if ($donate_count>0){
            echo json_encode(array(
                "code"=>-1,
                "message"=>"有捐助信息与此书关联，不允删除"
            ));
        }else{
            $agencyM=agency::model()->findByPk($agencyid);
            if ($agencyM->delete()){
                echo json_encode(array("code"=>0));
            }else{
                echo json_encode(array(
                    "code"=>-1,
                    "message"=>"删除失败"
                ));
            }
        }
    }

    public function actionAdd()
    {
        if (!empty($_POST)){
            agency::agencyAddOrChange($_POST);
            echo json_encode(array("code"=>0));
        }
    }
}