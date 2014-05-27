<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/15/14
 * Time: 10:25 AM
 */

class DonateController extends Controller
{
    public function actionIndex()
    {
        echo json_encode(array(
            'code'=>0,
        ));
    }

    public function actionGetdonateinfo()
    {
        $donateId=intval(Yii::app()->request->getParam('donateid',0));

        echo json_encode(donate::getInfo($donateId));
    }


    public function actionAddtrack()
    {
        $apitoken=Yii::app()->request->getParam("token");
        $uInfo=Yii::app()->user->getInfoByApiToken($apitoken);
        if ( empty($uInfo) || $uInfo["isadmin"]!="1"){
            echo json_encode(array(
                "code"=>-1,
                "message"=>"无权限",
            ));

            die();

        }


        $doanteId=intval(Yii::app()->request->getParam("donateid"));
        $information=Yii::app()->request->getParam("information");
        $lati=Yii::app()->request->getParam("lati");
        $longi=Yii::app()->request->getParam("longi");

        if ( (empty($doanteId)) || (empty($information)) || (empty($lati)) || (empty($longi))  ){
            echo json_encode(array(
                "code"=>-1,
                "message"=>"信息不全"
            ));
        }else{
            $saveRes=donate_track::addTrack(array(
                "donateid"=>$doanteId,
                "information"=>$information,
                "trackcoordinate"=>$lati.','.$longi,
            ));

            if ($saveRes){
                echo json_encode(array(
                    "code"=>0
                ));
            }else{
                echo json_encode(array(
                    "code"=>-1,
                    "message"=>"添加失败"
                ));
            }
        }
    }


    /**
     * 根据书籍名称搜索捐助信息
     */
    public function actionSearchbybook()
    {
        $search=Yii::app()->request->getParam("search",'');
        $limit=intval(Yii::app()->request->getParam("limit",10));
        $offset=intval(Yii::app()->request->getParam("offset",0));
        if (empty($search)){
            $condition=array(
                "order"=>"id desc",
            );
        }else{
            $bookS=book_lib::model()->findAll(array(
                "condition"=>"bookname like :bookname",
                "params"=>array(":bookname"=>"%".$search."%"),
            ));
            $strOfBookid="";

            foreach ($bookS as $oneBook) {
                $strOfBookid .=$oneBook->id.',';
            }

            $condition=array(
                "condition"=>"find_in_set(bookid,:bookids)",
                "params"=>array(":bookids"=>$strOfBookid),
                "order"=>"id desc",
            );
        }
        $donateCount=donate::model()->count($condition);

        $condition["offset"]=$offset;
        $condition["limit"]=$limit;
        $donateS=donate::model()->findAll($condition);
        $donateArr=array();
        foreach ($donateS as $oneDonate) {
            $donateArr[]=donate::getInfo($oneDonate->id);
        }

        echo json_encode(array(
            "offset"=>$offset,
            "limit"=>$limit,
            "recordsTotal"=>$donateCount,
            "donates"=>$donateArr,
        ));
    }


    /**
     * 根据捐赠点名称搜索捐助信息
     */
    public function actionSearchbyagency()
    {
        $search=Yii::app()->request->getParam("search",'');
        $limit=intval(Yii::app()->request->getParam("limit",10));
        $offset=intval(Yii::app()->request->getParam("offset",0));
        if (empty($search)){
            $condition=array(
                "order"=>"id desc",
            );
        }else{
            $agencys=agency::model()->findAll(array(
                "condition"=>"name like :name",
                "params"=>array(":name"=>"%".$search."%"),
            ));
            $strOfBookid="";

            foreach ($agencys as $oneBook) {
                $strOfBookid .=$oneBook->id.',';
            }


            $condition=array(
                "condition"=>"find_in_set(agencyid,:aids)",
                "params"=>array(":aids"=>$strOfBookid),
                "order"=>"id desc",
            );
        }
        $donateCount=donate::model()->count($condition);

        $condition["offset"]=$offset;
        $condition["limit"]=$limit;
        $donateS=donate::model()->findAll($condition);
        $donateArr=array();
        foreach ($donateS as $oneDonate) {
            $donateArr[]=donate::getInfo($oneDonate->id);
        }

        echo json_encode(array(
            "offset"=>$offset,
            "limit"=>$limit,
            "recordsTotal"=>$donateCount,
            "donates"=>$donateArr,
        ));
    }


    /**
     * 根据捐助者的用户名或昵称搜索捐助信息
     */
    public  function  actionSearchbydonor()
    {
        $search=Yii::app()->request->getParam("search",'');
        $limit=intval(Yii::app()->request->getParam("limit",10));
        $offset=intval(Yii::app()->request->getParam("offset",0));
        if (empty($search)){
            $condition=array(
                "order"=>"id desc",
            );
        }else{
            $agencys=user_info::model()->findAll(array(
                "condition"=>"username like :username or nickname like :nickname",
                "params"=>array(":username"=>"%".$search."%",":nickname"=>"%".$search."%"),
            ));
            $strOfBookid="";

            foreach ($agencys as $oneBook) {
                $strOfBookid .=$oneBook->id.',';
            }


            $condition=array(
                "condition"=>"find_in_set(donorid,:aids)",
                "params"=>array(":aids"=>$strOfBookid),
                "order"=>"id desc",
            );
        }
        $donateCount=donate::model()->count($condition);

        $condition["offset"]=$offset;
        $condition["limit"]=$limit;
        $donateS=donate::model()->findAll($condition);
        $donateArr=array();
        foreach ($donateS as $oneDonate) {
            $donateArr[]=donate::getInfo($oneDonate->id);
        }

        echo json_encode(array(
            "offset"=>$offset,
            "limit"=>$limit,
            "recordsTotal"=>$donateCount,
            "donates"=>$donateArr,
        ));
    }
}