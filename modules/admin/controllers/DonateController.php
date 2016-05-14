<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\DonateTrack;
use yii\web\Controller;
use app\models\Agency;
use app\models\Donate;
use app\models\UserInfo;
use app\models\BookLib;

class DonateController extends Controller
{
    public $title = "捐助管理";
    public $layout = "adminLayout";


    public function actionIndex()
    {
        $agencyModel = Agency::find()->all();
        return $this->render("donate", array('agencyAll' => $agencyModel));
    }

    public function actionGettable()
    {
        $donates = Donate::find()
            ->offset(Yii::$app->request->post('iDisplayStart', '0'))
            ->limit(Yii::$app->request->post('iDisplayLength', '10'))
            ->orderBy('id desc')
            ->all();
        $donateCount = Donate::find()->count();
        $datas = array();
        foreach ($donates as $onedonate) {
            $bookname = BookLib::getBookInfo($onedonate->bookid);
            $bookname = $bookname["bookname"];
            $agencyname = Agency::getAgencyInfo($onedonate->agencyid);
            $agencyname = $agencyname["name"];
            $donorname = UserInfo::getUserInfo($onedonate->donorid);
            $donorname = $donorname["nickname"];
            $datas[] = array(
                'id' => $onedonate->id,
                'bookname' => $bookname,
                'donorname' => $donorname,
                'agencyname' => $agencyname,
                'donatetime' => $onedonate->donatetime,
            );
        }
        return json_encode(array(
            "draw" => intval(Yii::$app->request->post("draw")),
            "recordsTotal" => $donateCount,
            "recordsFiltered" => $donateCount,
            "data" => $datas,
        ));
    }

    /**
     * ajax 添加新的捐赠信息
     * 绑定书籍书籍信息，必须选择一个书籍ID
     * 绑定用户信息，用户不存在则新建一个用户，填写初始信息，但未激活
     * 绑定捐赠点信息，必须选择一个捐赠点ID
     * 添加一条追踪信息
     */
    public function actionAdddonate()
    {
        $bookid = intval(Yii::$app->request->post('bookid'));
        $donoremail = Yii::$app->request->post('donoremail', '');
        $agencyid = intval(Yii::$app->request->post('agencyid'));
        $description = Yii::$app->request->post('description');

        if (empty($donoremail)) {
            $donorid = 0;
        } else {
            $donorObj = UserInfo::find()
                ->where('username = :username', [':username' => $donoremail])
                ->one();
            $donorid = ($donorObj) ? $donorObj->id : 0;
            if ($donorid == 0) {
                $newUserM = new UserInfo();
                $newUserM->username = $donoremail;
                $newUserM->passwd = "-1";
                $newUserM->nickname = $donoremail;
                $newUserM->token = "-1";
                $newUserM->isadmin = 0;
                $newUserM->save();
                $donorid = $newUserM->id;
            }
        }
        if (isset($bookid) && isset($agencyid)) {
            $donateId = Donate::recordNewOrChange(array(
                "bookid" => $bookid,
                "donorid" => $donorid,
                "agencyid" => $agencyid,
                "description" => $description,
            ));
            if ($donateId) {
                return json_encode(array(
                    'code' => 0,
                    'donateid' => $donateId,
                ));
            } else {
                return json_encode(array(
                    'code' => -1,
                    'message' => '添加失败',
                ));
            }
        } else {
            return json_encode(array(
                'code' => -1,
                'message' => '请选择书籍或捐助点',
            ));
        }

    }

    public function actionDeldonate()
    {
        $donateId = intval(Yii::$app->request->post("donateid"));
        $delRes = Donate::findOne($donateId)->delete();
        if ($delRes) {
            return json_encode(array(
                'code' => 0
            ));
        } else {
            return json_encode(array(
                "code" => -1,
                "message" => "删除失败"
            ));
        }
    }

    /**
     * 添加书籍追踪信息，并以json格式返回到前端
     * 前端根据信息显示效果
     */
    public function actionAddtrack()
    {
        $doanteId = intval(Yii::$app->request->post("donateid"));
        $information = Yii::$app->request->post("information");
        $lati = Yii::$app->request->post("lati");
        $longi = Yii::$app->request->post("longi");

        if ((empty($doanteId)) || (empty($information)) || (empty($lati)) || (empty($longi))) {
            return json_encode(array(
                "code" => -1,
                "message" => "信息不全"
            ));
        } else {
            $saveRes = DonateTrack::addTrack(array(
                "donateid" => $doanteId,
                "information" => $information,
                "trackcoordinate" => $lati . ',' . $longi,
            ));

            if ($saveRes) {
                return json_encode(array(
                    "code" => 0
                ));
            } else {
                return json_encode(array(
                    "code" => -1,
                    "message" => "添加失败"
                ));
            }
        }
    }
}
