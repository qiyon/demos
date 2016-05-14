<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\UserInfo;

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
        $url = Yii::$app->request->post('url');
        $username = Yii::$app->request->post('username');
        $passwd = Yii::$app->request->post('passwd');
        $remember = intval(Yii::$app->request->post('remember', 0));
        if (!empty($username)) {
            $identityObj = UserInfo::find()
                ->where('username = :username', [':username' => $username])
                ->one();
            if ($identityObj && UserInfo::checkPassword($passwd, $identityObj->passwd)) {
                Yii::$app->user->login($identityObj, $remember ? 7 * 24 * 3600 : 0);
                if (empty($url)) $url = "/admin";
                return $this->redirect($url);
            } else {
                return $this->render("login", array(
                    'errortype' => 'warning',
                    'message' => '用户名或密码错误！'
                ));
            }
        } else {
            return $this->render("login");
        }
    }

    /**
     * 注销操作
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/admin/index/login');
    }
}
