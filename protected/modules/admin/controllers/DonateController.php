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

    /**
     * ajax 添加新的捐赠信息
     * 绑定书籍书籍信息，必须选择一个书籍ID
     * 绑定用户信息，用户不存在则新建一个用户，填写初始信息，但未激活
     * 绑定捐赠点信息，必须选择一个捐赠点ID
     * 添加一条追踪信息
     */
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
            if($donorid==0){
                $newUserM=new user_info();
                $newUserM->username=$donoremail;
                $newUserM->passwd="-1";
                $newUserM->nickname=$donoremail;
                $newUserM->token="-1";
                $newUserM->isadmin=0;

                $newUserM->save();
                $donorid=$newUserM->id;
            }
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

    public function actionDeldonate(){
        $donateId=intval(Yii::app()->request->getParam("donateid"));
        $delRes=donate::model()->findByPk($donateId)->delete();
        if ($delRes){
            echo json_encode(array(
                'code'=>0
            ));
        }else{
            echo json_encode(array(
                "code"=>-1,
                "message"=>"删除失败"
            ));
        }
    }

    /**
     * 添加书籍追踪信息，并以json格式返回到前端
     * 前端根据信息显示效果
     */
    public function actionAddtrack()
    {
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
}