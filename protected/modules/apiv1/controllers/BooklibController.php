<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/13/14
 * Time: 9:43 PM
 */


class BooklibController extends Controller
{
    public function actionIndex()
    {
        echo json_encode(array(
            "code"=>0,

        ));
    }

    /**
     * 获取书籍列表
     */
    public function actionGetlist()
    {
        $seachBook=Yii::app()->request->getParam("search","");
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
        $conditon["limit"]=intval(Yii::app()->request->getParam("limit",10));
        $conditon["offset"]=intval(Yii::app()->request->getParam("offset",0));
        $books=book_lib::model()->findAll($conditon);
        $bookDatas=array();
        foreach ($books as $bookInfo) {
            $bookDatas[]=array(
                "id"=>$bookInfo->id,
                "bookname"=>$bookInfo->bookname,
                "author"=>$bookInfo->author,
                "pub_house"=>$bookInfo->pub_house,
                "ISBN"=>$bookInfo->ISBN,
                "about_link"=>$bookInfo->about_link,
                "tags"=>$bookInfo->tags,
                "description"=>$bookInfo->description,
            );


        }

        echo json_encode(array(
            "offset"=>$conditon["offset"],
            "limit"=>$conditon["limit"],
            "recordsTotal"=>$bookCount,
            "books"=>$bookDatas,
        ));

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
     * 添加书籍记录
     */
    public function  actionAddbook()
    {
        $apitoken=Yii::app()->request->getParam("token");
        $addinfo=array(
            "bookname"=>Yii::app()->request->getParam("bookname",""),
            "author"=>Yii::app()->request->getParam("author",""),
            "pub_house"=>Yii::app()->request->getParam("pub_house",""),
            "ISBN"=>Yii::app()->request->getParam("ISBN",""),
            "about_link"=>Yii::app()->request->getParam("about_link",""),
            "tags"=>Yii::app()->request->getParam("tags",""),
            "description"=>Yii::app()->request->getParam("description",""),
        );
        if (empty($addinfo["bookname"])) {
            echo json_encode(array(
                "code"=>-1,
                "message"=>"书名不能为空",
            ));
            die();
        }
        $uInfo=Yii::app()->user->getInfoByApiToken($apitoken);
        if (isset($uInfo) && $uInfo["isadmin"]=="1"){

            $saveID=book_lib::bookAddOrChange($addinfo);
            if ($saveID){
                echo json_encode(array(
                    "code"=>0,
                    "bookid"=>$saveID,
                ));
            }else{
                echo json_encode(array(
                    "code"=>-1,
                    "message"=>"添加失败",
                ));
            }
        }else{
            echo json_encode(array(
                "code"=>-1,
                "message"=>"无权限",
            ));
        }
    }
}