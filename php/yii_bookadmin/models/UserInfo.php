<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord as CActiveRecord;

class UserInfo extends CActiveRecord implements \yii\web\IdentityInterface
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
        $nullInfo = [
            'id'       => 0,
            'username' => 'nothing',
            'nickname' => '无信息',
            'isadmin'  => 0,
        ];
        $Model_U = self::findOne($userid);
        if (empty($Model_U)) {
            return $nullInfo;
        } else {
            return [
                'id'       => $Model_U->id,
                'username' => $Model_U->username,
                'nickname' => $Model_U->nickname,
                'isadmin'  => $Model_U->isadmin,
            ];
        }
    }

    public static function checkPassword($inputPassword, $dbPassword)
    {
        Yii::info('md5: ' . md5(Yii::$app->params['sxUserSlat'] . $inputPassword));
        Yii::info('db:' . $dbPassword);
        return !!(md5(Yii::$app->params['sxUserSlat'] . $inputPassword) === $dbPassword);
    }

    //---------   \yii\web\IdentityInterface functions -----------------
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return md5('sxamdinAuthKey' . $this->getId());
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
