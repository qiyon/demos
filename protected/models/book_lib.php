<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 2:04 PM
 */

class book_lib extends CActiveRecord
{
    public static  function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public  function tableName()
    {
        return "book_lib";
    }


    /**
     * 书籍信息存入数据库，无bookid为新建，有为修改
     * @param $bookInfo
     * @return bool
     */
    public static function bookAddOrChange($bookInfo)
    {
        if(isset($bookInfo['bookid']) ){
            $booklib_model=self::model()->find("id=:id",array(":id"=>$bookInfo["bookid"]));
        }else{
            $booklib_model=new self();
        }
        $booklib_model->bookname=$bookInfo["bookname"];
        $booklib_model->author=$bookInfo["author"];
        $booklib_model->pub_house=$bookInfo["pub_house"];
        $booklib_model->ISBN=$bookInfo["ISBN"];
        $booklib_model->about_link=$bookInfo["about_link"];
        $booklib_model->tags=$bookInfo["tags"];
        $booklib_model->description=$bookInfo["description"];

        return $booklib_model->save();
    }
}