<?php
namespace app\models;

use yii\db\ActiveRecord as CActiveRecord;
use app\models\DonateTrack as donate_track;
use app\models\Agency;
use app\models\BookLib as book_lib;
use app\models\UserInfo as user_info;

/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 2:48 PM
 */
class Donate extends CActiveRecord
{

    public static function tableName()
    {
        return "donate";
    }


    /**
     * 添加或修改捐助记录
     * @param $donateInfo
     * @return array|bool|mixed|null
     */
    public static function recordNewOrChange($donateInfo)
    {
        if (isset($donateInfo["donateid"])) {
            $Model_d = self::model()->findByPk(intval($donateInfo["donateid"]));
        } else {
            $Model_d = new self();
            $Model_d->donatetime = new CDbExpression('NOW()');
        }
        $Model_d->bookid = $donateInfo["bookid"];
        $Model_d->donorid = $donateInfo["donorid"];
        $Model_d->agencyid = $donateInfo["agencyid"];
        $Model_d->description = $donateInfo["description"];

        $saveId = $Model_d->save();
        if ($saveId) {
            $agencyInfo = Agency::model()->findByPk($donateInfo["agencyid"]);
            donate_track::addTrack(array(
                "donateid" => $Model_d->id,
                "information" => "捐助信息添加进入数据库",
                "trackcoordinate" => $agencyInfo->coordinate,
            ));
            return $saveId;
        } else {
            return false;
        }
    }


    /**
     * 获取捐助信息
     * @param $donateid
     * @return array
     */
    public static function getInfo($donateid)
    {
        $donateid = intval($donateid);
        $Model_donate = self::find()->where(['id' => $donateid])->one();
        if (empty($Model_donate)) {
            return array(
                'id' => 0,
                'donatetime' => '',
                'description' => '',
                'bookinfo' => book_lib::getBookInfo(0),
                'donorinfo' => user_info::getUserInfo(0),
                'agencyinfo' => Agency::getAgencyInfo(0),
                'tracks' => array(),
            );
        } else {
            return array(
                'id' => $Model_donate->id,
                'donatetime' => $Model_donate->donatetime,
                'description' => $Model_donate->description,
                'bookinfo' => book_lib::getBookInfo($Model_donate->bookid),
                'donorinfo' => user_info::getUserInfo($Model_donate->donorid),
                'agencyinfo' => Agency::getAgencyInfo($Model_donate->agencyid),
                "tracks" => donate_track::getTrack($Model_donate->id),
            );
        }
    }
}
