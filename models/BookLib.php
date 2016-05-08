<?php
namespace app\models;

use yii\db\ActiveRecord as CActiveRecord;

/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 2:04 PM
 */
class BookLib extends CActiveRecord
{
    public static function tableName()
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
        if (isset($bookInfo['bookid'])) {
            $booklib_model = self::model()->find("id=:id", array(":id" => $bookInfo["bookid"]));
        } else {
            $booklib_model = new self();
        }
        $booklib_model->bookname = $bookInfo["bookname"];
        $booklib_model->author = $bookInfo["author"];
        $booklib_model->pub_house = $bookInfo["pub_house"];
        $booklib_model->ISBN = $bookInfo["ISBN"];
        $booklib_model->about_link = $bookInfo["about_link"];
        $booklib_model->tags = $bookInfo["tags"];
        $booklib_model->description = $bookInfo["description"];

        if ($booklib_model->save()) {
            return $booklib_model->id;
        } else {
            return false;
        }
    }

    /**
     * 删除某一本书的信息，前提是无捐助信息绑定到这本书，
     * -1代表有捐助信息相关，不予删除
     * 1代表删除成功
     * 0代表删除失败
     * @param $bookid
     * @return int
     */
    public static function bookDelete($bookid)
    {
        $bookid = intval($bookid);
        $donate_count = donate::model()->count("bookid=:bookid", array(":bookid" => $bookid));
        if ($donate_count > 0) {
            return -1;
        }

        $book_model = self::model()->find("id=:id", array(":id" => $bookid));
        if ($book_model->delete()) {
            return 1;
        } else {
            return 0;
        }
    }


    /**
     * 通过书籍Id获取书籍信息，无法查询时也返回空信息
     * @param $bookid
     * @return array
     */
    public static function getBookInfo($bookid)
    {
        $bookid = intval($bookid);
        $nullbook = array(
            'id' => 0,
            'bookname' => '无记录',
            'author' => '无记录',
            'ISBN' => '',
            'pub_house' => '',
            'about_link' => '',
            'description' => '',
            'tags' => '',

        );
        $Model_b = self::find()->where(['id' => $bookid])->one();
        if (empty($Model_b)) {
            return $nullbook;
        } else {
            return array(
                'id' => $Model_b->id,
                'bookname' => $Model_b->bookname,
                'author' => $Model_b->author,
                'ISBN' => $Model_b->ISBN,
                'pub_house' => $Model_b->pub_house,
                'about_link' => $Model_b->about_link,
                'description' => $Model_b->description,
                'tags' => $Model_b->tags,
            );
        }
    }

}
