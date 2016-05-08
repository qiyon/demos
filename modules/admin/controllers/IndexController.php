<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;

class IndexController extends Controller
{
    /**
     * 设置页面布局
     * @var string
     */
    public $layout = "adminLayout";

    /**
     * 加载视图
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 登陆界面
     */
    public function actionLogin()
    {
        $this->layout = "";
        $this->title = "Login";
        $url = Yii::$app->request->get('url');
        $username = Yii::$app->request->get('username');
        $passwd = Yii::$app->request->get('passwd');
        if (!empty($username)) {
            if (Yii::$app->user->loginAuth($username, $passwd)) {
                $remember = intval(Yii::$app->request->get('remember', '0'));
                Yii::$app->user->login($username, $remember);
                if (empty($url)) {
                    header("Location:?r=index/index");
                } else {
                    header("Location:?r={$url}");
                }
            } else {
                $this->render("login", array(
                    'errortype' => 'warning',
                    'message' => '用户名或密码错误！'
                ));
            }
        } else {
            $this->render("login");
        }
    }

    /**
     * 注销操作
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
//        header("Location:" . '/admin/index/login');
        return $this->redirect('/admin/index/login');
    }
}
