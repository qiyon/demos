<?php
namespace app\models;
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 2:50 PM
 */

class DonateTrack extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "donate_track";
    }


    public static function getTrack($donateid)
    {
        $donateid=intval($donateid);

        $trackM=donate_track::model()->findAll(array(
            'condition'=>"donateid=:donateid",
            "params"=>array("donateid"=>$donateid),
        ));
        $trackArr=array();
        foreach ($trackM as $oneTrack) {
            $tkCoordinate=explode(',',$oneTrack->trackcoordinate);
            $trackArr[]=array(
                "tracktime"=>$oneTrack->tracktime,
                "information"=>$oneTrack->information,
                "trackcoordinate"=>$oneTrack->trackcoordinate,
                "tracklongi"=>$tkCoordinate[1],
                "tracklati"=>$tkCoordinate[0],
            );
        }


        return  $trackArr;

    }

    public static function addTrack($trackInfo)
    {
        $trackM=new self();
        $trackM->donateid=$trackInfo["donateid"];
        $trackM->tracktime=new CDbExpression("NOW()");
        $trackM->information=$trackInfo["information"];
        $trackM->trackcoordinate=$trackInfo["trackcoordinate"];

        return $trackM->save();
    }
}
