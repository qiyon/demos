<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 2:50 PM
 */

class donate_track extends CActiveRecord
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
            $trackArr[]=array(
                "tracktime"=>$oneTrack->tracktime,
                "information"=>$oneTrack->information,
            );
        }


        return  $trackArr;

    }
}