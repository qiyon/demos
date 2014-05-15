<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/8/14
 * Time: 11:01 AM
 */
class DonateController extends Controller
{
    public $title="捐助管理";
    public $layout="//layouts/adminLayout";

    public function getViewPath()
    {
        return $this->getModule()->getViewPath();
    }

    public function actionIndex()
    {
        $agencyModel=agency::model()->findAll();
        $this->render("donate",array('agencyAll'=>$agencyModel));
    }

    public function actionGettable()
    {
        $donates=donate::model()->findAll(array(
            'offset'=>Yii::app()->request->getParam('iDisplayStart','0'),
            'limit'=>Yii::app()->request->getParam('iDisplayLength','10'),
            'order'=>'id desc'
        ));
        $donateCount=donate::model()->count();
        $datas=array();
        foreach ($donates as $onedonate) {
            $bookname=book_lib::getBookInfo($onedonate->bookid);
            $bookname=$bookname["bookname"];
            $agencyname=agency::getAgencyInfo($onedonate->agencyid);
            $agencyname=$agencyname["name"];
            $donorname=user_info::getUserInfo($onedonate->donorid);
            $donorname=$donorname["nickname"];


            $datas[]=array(
                'id'=>$onedonate->id,
                'bookname'=>$bookname,
                'donorname'=>$donorname,
                'agencyname'=>$agencyname,
                'donatetime'=>$onedonate->donatetime,
            );
        }

        echo json_encode(array(
            "draw"=>intval(Yii::app()->request->getParam("draw")),
            "recordsTotal"=>$donateCount,
            "recordsFiltered"=>$donateCount,
            "data"=>$datas,
        ));
    }

    public function actionAdddonate()
    {
        $bookid=intval(Yii::app()->request->getParam('bookid'));
        $donoremail=Yii::app()->request->getParam('donoremail','');
        $agencyid=intval(Yii::app()->request->getParam('agencyid'));
        $description=Yii::app()->request->getParam('description');

        if (empty($donoremail)) {
            $donorid=0;
        }else{
            $donorid=Yii::app()->user->getIdBYUsername($donoremail);
        }
        if (isset($bookid)&&isset($agencyid)){

            $donateId=donate::recordNewOrChange(array(
                "bookid"=>$bookid,
                "donorid"=>$donorid,
                "agencyid"=>$agencyid,
                "description"=>$description,
            ));

            if ($donateId){
                echo json_encode(array(
                    'code'=>0,
                    'donateid'=>$donateId,
                ));
            }else{
                echo json_encode(array(
                    'code'=>-1,
                    'message'=>'添加失败',
                ));
            }
        }else{
            echo json_encode(array(
                'code'=>-1,
                'message'=>'请选择书籍或捐助点',
            ));
        }

    }
}