<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\BookLib;

class BooklibController extends Controller
{
    public $layout = "adminLayout";

    public $title = "书籍管理";

    public function actionIndex()
    {
        return $this->render("booklib");
    }

    /**
     * 获取书籍信息，提供搜索和分页功能
     * 将信息通过json格式传送到Web端
     */
    public function actionBooktable()
    {
        $seachBook = Yii::$app->request->get("search_book");
        $query = BookLib::find();
        if (!empty($seachBook)) {
            $query->where('bookname like :bookname', [':bookname' => '%' . $seachBook . '%']);
        }
        $bookCount = $query->count();
        $query->orderBy('id desc')
            ->offset(intval(Yii::$app->request->get("iDisplayStart")))
            ->limit(intval(Yii::$app->request->get("iDisplayLength")));
        $books = $query->all();
        $bookDatas = array();
        foreach ($books as $bookInfo) {
            $bookDatas[] = array(
                "id" => $bookInfo->id,
                "bookname" => $bookInfo->bookname,
                "author" => $bookInfo->author,
                "pub_house" => $bookInfo->pub_house,
                "ISBN" => $bookInfo->ISBN,
            );
        }
        return json_encode(array(
            "draw" => intval(Yii::$app->request->get("draw")),
            "recordsTotal" => $bookCount,
            "recordsFiltered" => $bookCount,
            "data" => $bookDatas,
        ));
    }

    /**
     * Ajax添加书籍信息，并通过json数据格式返回成功与否的信息到Web端
     */
    public function actionAddbook()
    {
        if (empty($_POST["bookname"])) {
            return json_encode(array(
                "code" => -1,
                "message" => "书名不能为空",
            ));
        }
        if (BookLib::bookAddOrChange($_POST)) {
            return json_encode(array(
                "code" => 0,
            ));
        } else {
            return json_encode(array(
                "code" => -1,
                "message" => "添加失败",
            ));
        }
    }

    public function actionGetlist()
    {
        $searchBook = Yii::$app->request->post('search', '');
        $query = BookLib::find();
        if (!empty($searchBook)) {
            $query->where('bookname like :bookname', array(':bookname' => '%' . $searchBook . '%'));
        }
        $query->orderBy('id desc');
        $bookList = $query->all();
        $boobArray = array();
        foreach ($bookList as $onebook) {
            $boobArray[] = array(
                'id' => $onebook->id,
                'bookname' => $onebook->bookname,
                'author' => $onebook->author,
                'ISBN' => $onebook->ISBN,
            );
        }
        return json_encode(array(
            'code' => 0,
            'data' => $boobArray,
        ));
    }

    public function actionDelbook()
    {
        $bookid = intval(Yii::$app->request->post("bookid"));
        $delRes = BookLib::bookDelete($bookid);
        if ($delRes == -1) {
            return json_encode(array(
                "code" => -1,
                "message" => "有捐助信息与此书关联，禁止删除",
            ));
        } elseif ($delRes == 1) {
            return json_encode(array(
                "code" => 0,
            ));
        } else {
            return json_encode(array(
                "code" => -11,
                "message" => "删除失败"
            ));
        }
    }

    /**
     * 通过id获取书籍信息
     */
    public function actionGetinfobyid()
    {
        $bookid = intval(Yii::$app->request->get("bookid"));
        return json_encode(BookLib::getBookInfo($bookid));
    }


    /**
     * 编辑书籍信息
     */
    public function actionEdit()
    {
        if (empty($_POST["bookname"])) {
            return json_encode(array(
                "code" => -1,
                "message" => "书名不能为空",
            ));
        }
        if (BookLib::bookAddOrChange($_POST)) {
            return json_encode(array(
                "code" => 0,
            ));
        } else {
            return json_encode(array(
                "code" => -1,
                "message" => "编辑失败",
            ));
        }
    }
}
