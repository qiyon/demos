<?php
namespace app\models;

use yii\db\ActiveRecord as CActiveRecord;

/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/5/14
 * Time: 8:59 PM
 */
class UserInfo extends CActiveRecord
{
    public static function tableName()
    {
        return "user_info";
    }

    /**
     * 通过用户id获取基本的用用户信息，不存时也返回相关信息
     * @param $userid
     * @return array
     */
    public static function getUserInfo($userid)
    {
        $userid = intval($userid);
        $nullInfo = array(
            'id' => 0,
            'username' => 'nothing',
            'nickname' => '无信息',
            'isadmin' => 0,
        );
        $Model_U = self::find()->where(['id' => $userid])->one();
        if (empty($Model_U)) {
            return $nullInfo;
        } else {
            return array(
                'id' => $Model_U->id,
                'username' => $Model_U->username,
                'nickname' => $Model_U->nickname,
                'isadmin' => $Model_U->isadmin,
            );
        }
    }
}
