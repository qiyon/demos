<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 2:07 PM
 */


class BooklibController extends Controller
{
    public $layout="//layouts/adminLayout";

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
}


