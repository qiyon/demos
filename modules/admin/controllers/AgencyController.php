<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Agency;
use app\models\Donate;

class AgencyController extends Controller
{
    public $layout = "adminLayout";

    public $title = "捐赠点管理";

    /**
     * 读取捐赠点信息并传送到view视图显示
     */
    public function actionIndex()
    {
        $agenM = Agency::find()->all();
        return $this->render("agency", array("agencys" => $agenM));
    }

    /**
     * 获取捐赠点想信息
     * json返回
     */
    public function actionGetinfo()
    {
        $agencyId = intval(Yii::$app->request->post("agencyid"));
        $info = Agency::getAgencyInfo($agencyId);
        return json_encode(array(
            "code" => 0,
            "info" => $info,
        ));
    }

    /**
     * 捐赠点信息编辑
     */
    public function actionEdit()
    {
        if (isset($_POST["agencyid"])) {
            $resV = Agency::agencyAddOrChange($_POST);
        }

        if (!empty($resV)) {
            return json_encode(array(
                "code" => 0
            ));
        } else {
            return json_encode(array(
                "code" => -1,
                "message" => "修改失败"
            ));
        }
    }

    public function actionDelete()
    {
        $agencyid = intval(Yii::$app->request->post("agencyid"));
        $donate_count = Donate::find()
            ->where("agencyid=:aid", array(":aid" => $agencyid))
            ->count();
        if ($donate_count > 0) {
            return json_encode(array(
                "code" => -1,
                "message" => "有捐助信息与此书关联，不允删除"
            ));
        } else {
            $agencyM = Agency::findOne($agencyid);
            if ($agencyM->delete()) {
                return json_encode(array("code" => 0));
            } else {
                return json_encode(array(
                    "code" => -1,
                    "message" => "删除失败"
                ));
            }
        }
    }

    public function actionAdd()
    {
        if (!empty($_POST)) {
            Agency::agencyAddOrChange($_POST);
            return json_encode(array("code" => 0));
        }
    }
}
