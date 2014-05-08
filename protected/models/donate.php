<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 2:48 PM
 */

class donate extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
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
        if (isset($donateInfo["donateid"])){
            $Model_d=self::model()->findByPk(intval($donateInfo["donateid"]));
        }else{
            $Model_d=new self();
            $Model_d->donatetime=time();
        }
        $Model_d->bookid=$donateInfo["bookid"];
        $Model_d->dornorid=$donateInfo["dornorid"];
        $Model_d->agencyid=$donateInfo["agencyid"];
        $Model_d->description=$donateInfo["description"];

        if ($Model_d->save()){
            return $Model_d->id;
        }else{
            return false;
        }
    }

    public static function getInfo($donateid)
    {
        $donateid=intval($donateid);
        $Model_donate=self::model()->findByPk($donateid);
        if(empty($Model_donate)){
            return array(
                'id'=>0,
                'donatetime'=>'',
                'description'=>'',
                'bookinfo'=>book_lib::getBookInfo(0),
                'dornorinfo'=>user_info::getUserInfo(0),
                'agencyinfo'=>agency::getAgencyInfo(0),
            );
        }else{
            return array(
                'id'=>$Model_donate->id,
                'donatetime'=>$Model_donate->donatetime,
                'description'=>$Model_donate->description,
                'bookinfo'=>book_lib::getBookInfo(0),
                'dornorinfo'=>user_info::getUserInfo(0),
                'agencyinfo'=>agency::getAgencyInfo(0),
            );
        }


    }


}