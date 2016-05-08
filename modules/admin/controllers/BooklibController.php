<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 2:07 PM
 */


class BooklibController extends Controller
{
    public $layout="//layouts/adminLayout";

    public $title="书籍管理";

    /**
     * 更改视图路径到../view/下
     */
    public function getViewPath()
    {
        return $this->getModule()->getViewPath();
    }


    public function actionIndex()
    {
        $this->render("booklib");
    }

    /**
     * 获取书籍信息，提供搜索和分页功能
     * 将信息通过json格式传送到Web端
     */
    public function actionBookTable()
    {
        $seachBook=Yii::app()->request->getParam("search_book");
        if (!empty($seachBook)){
            $conditon=array(
                'condition'=>"bookname like :bookname",
                'params'=>array(':bookname'=>'%'.$seachBook.'%'),
            );
        }else{
            $conditon=array();
        }

        $bookCount=book_lib::model()->count($conditon);

        $conditon["order"]=" id desc";
        $conditon["limit"]=intval(Yii::app()->request->getParam("iDisplayLength"));
        $conditon["offset"]=intval(Yii::app()->request->getParam("iDisplayStart"));
        $books=book_lib::model()->findAll($conditon);
        $bookDatas=array();
        foreach ($books as $bookInfo) {
            $bookDatas[]=array(
                "id"=>$bookInfo->id,
                "bookname"=>$bookInfo->bookname,
                "author"=>$bookInfo->author,
                "pub_house"=>$bookInfo->pub_house,
                "ISBN"=>$bookInfo->ISBN,
            );
        }

        echo json_encode(array(
            "draw"=>intval(Yii::app()->request->getParam("draw")),
            "recordsTotal"=>$bookCount,
            "recordsFiltered"=>$bookCount,
            "data"=>$bookDatas,
        ));

    }

    /**
     * Ajax添加书籍信息，并通过json数据格式返回成功与否的信息到Web端
     */
    public function actionAddbook()
    {
        if(empty($_POST["bookname"])){
            echo json_encode(array(
                "code"=>-1,
                "message"=>"书名不能为空",
            ));
            return ;
        }
        if(book_lib::bookAddOrChange($_POST)){
            echo json_encode(array(
                "code"=>0,
            ));
        }else{
            echo json_encode(array(
                "code"=>-1,
                "message"=>"添加失败",
            ));
        }
    }

    public function actionGetlist()
    {
        $searchBook=Yii::app()->request->getParam('search','');
        if(empty($searchBook)){
            $condition=array();
        }else{
            $condition=array(
                'condition'=>'bookname like :bookname',
                'params'=>array(':bookname'=>'%'.$searchBook.'%'),
            );
        }
        $condition["order"]='id desc';
        $bookList=book_lib::model()->findAll($condition);
        $boobArray=array();
        foreach($bookList as $onebook){
            $boobArray[]=array(
                'id'=>$onebook->id,
                'bookname'=>$onebook->bookname,
                'author'=>$onebook->author,
                'ISBN'=>$onebook->ISBN,
            );
        }
        echo json_encode(array(
            'code'=>0,
            'data'=>$boobArray,
        ));
    }

    public function actionDelbook()
    {
        $bookid=intval(Yii::app()->request->getParam("bookid"));
        $delRes=book_lib::bookDelete($bookid);
        if ($delRes==-1){
            echo json_encode(array(
                "code"=>-1,
                "message"=>"有捐助信息与此书关联，禁止删除",
            ));
        }elseif($delRes==1){
            echo json_encode(array(
                "code"=>0,
            ));
        }else{
            echo json_encode(array(
                "code"=>-11,
                "message"=>"删除失败"
            ));
        }
    }

    /**
     * 通过id获取书籍信息
     */
    public function actionGetinfobyid()
    {
        $bookid=intval(Yii::app()->request->getParam("bookid"));
        echo json_encode(book_lib::getBookInfo($bookid));
    }


    /**
     * 编辑书籍信息
     */
    public function actionEdit()
    {
        if(empty($_POST["bookname"])){
            echo json_encode(array(
                "code"=>-1,
                "message"=>"书名不能为空",
            ));
            return ;
        }
        if(book_lib::bookAddOrChange($_POST)){
            echo json_encode(array(
                "code"=>0,
            ));
        }else{
            echo json_encode(array(
                "code"=>-1,
                "message"=>"编辑失败",
            ));
        }
    }
}
