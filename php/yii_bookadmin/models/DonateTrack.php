<?php

namespace app\models;

use yii\db\ActiveRecord as CActiveRecord;

class DonateTrack extends CActiveRecord
{
    public static function tableName()
    {
        return "donate_track";
    }

    public static function getTrack($donateid)
    {
        $donateid = intval($donateid);
        $trackM = self::find()->where(['donateid' => $donateid])->all();
        $trackArr = [];
        foreach ($trackM as $oneTrack) {
            $tkCoordinate = explode(',', $oneTrack->trackcoordinate);
            $trackArr[] = [
                "tracktime"       => $oneTrack->tracktime,
                "information"     => $oneTrack->information,
                "trackcoordinate" => $oneTrack->trackcoordinate,
                "tracklongi"      => isset($tkCoordinate[1]) ? $tkCoordinate[1] : '',
                "tracklati"       => isset($tkCoordinate[0]) ? $tkCoordinate[0] : '',
            ];
        }
        return $trackArr;
    }

    public static function addTrack($trackInfo)
    {
        $trackM = new self();
        $trackM->donateid = $trackInfo["donateid"];
        $trackM->tracktime = date('Y-m-d H:i:s', time());
        $trackM->information = $trackInfo["information"];
        $trackM->trackcoordinate = $trackInfo["trackcoordinate"];
        return $trackM->save();
    }
}
