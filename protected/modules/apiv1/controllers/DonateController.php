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
                $strOfBookid .=$oneBook->id;
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
}