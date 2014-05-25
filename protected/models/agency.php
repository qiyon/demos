<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 12:32 PM
 */
class agency extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return "agency";
    }


    /**
     * 捐助点添加或修改
     * @param $agencyInfo
     * @return bool
     */
    public static function agencyAddOrChange($agencyInfo)
    {
        if (isset($agencyInfo["agencyid"])){
            $agency_model=self::model()->findByPk($agencyInfo["agencyid"]);
        }else{
            $agency_model=new self();
        }

        $agency_model->name=$agencyInfo["name"];
        $agency_model->person=$agencyInfo["person"];
        $agency_model->address=$agencyInfo["address"];
        $agency_model->telephone=$agencyInfo["telephone"];
        $agency_model->worktime=$agencyInfo["worktime"];
        $agency_model->coordinate=$agencyInfo["coordinate"];
        $agency_model->description=$agencyInfo["description"];

        if ( $agency_model->save() ){
            return $agency_model->id;
        }else{
            return false;
        }

    }

    /**
     * 删除捐助点信息，有相关捐助信息绑定时不予删除，此时状态为-1
     * 删除成功1；
     * 失败0。
     *
     * 可自行添加字段表征 捐助点的不可用
     *
     * @param $agencyid
     * @return int
     */
    public  static function agencyDelete($agencyid)
    {
        $agencyid=intval($agencyid);
        if(donate::model()->count("agencyid=:agencyid",array(":agencyid"=>$agencyid))>0){
            return -1;
        }

        $agencyModel=self::model()->findByPk($agencyid);
        if ( $agencyModel->delete() ){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * 获取捐赠点机构信息,无法查询时同样返回
     * @param $agencyid
     * @return array
     */
    public static function getAgencyInfo($agencyid)
    {
        $agencyid=intval($agencyid);
        $nullAgency=array(
            'id'=>0,
            'name'=>'暂无信息',
            'person'=>'',
            'address'=>'',
            'telephone'=>'',
            'worktime'=>'',
            'coordinate'=>'0,0',
            'longi'=>'0',
            'lati'=>'0',
            'description'=>'',
        );
        $Model_A=self::model()->findByPk($agencyid);
        if(empty($Model_A)){
            return $nullAgency;
        }else{
            $coordinate=explode(',',$Model_A->coordinate);
            return array(
                'id'=>$Model_A->id,
                'name'=>$Model_A->name,
                'person'=>$Model_A->person,
                'address'=>$Model_A->address,
                'telephone'=>$Model_A->telephone,
                'worktime'=>$Model_A->worktime,
                'coordinate'=>$Model_A->coordinate,
                'description'=>$Model_A->description,
                "longi"=>$coordinate[1],
                "lati"=>$coordinate[0],
            );
        }
    }
}



