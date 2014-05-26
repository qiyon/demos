<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 11:11 AM
 */


class IndexController extends Controller
{
    /**
     * 设置页面布局
     * @var string
     */
    public $layout="//layouts/adminLayout";

    /**
     * 加载视图
     */
    public function actionIndex(){
        $this->title = "后台管理";
        $this->render('index');
    }

    /**
     * 设置管理页面主题，将主题选择存储在cookie中，有效期一年
     */
    public function actionSetTheme()
    {
        $cookie=new CHttpCookie("sx-theme",Yii::app()->request->getParam("theme"));
        $cookie->expire=time()+365*24*60*60;
        Yii::app()->request->cookies["sx-theme"]=$cookie;
        echo 0;
    }

    /**
     * 登陆界面
     */
    public function actionLogin(){
        $this->layout="";
        $this->title = "Login";
        $url=Yii::app()->request->getParam('url');
        $username=Yii::app()->request->getParam('username');
        $passwd=Yii::app()->request->getParam('passwd');
        if (!empty($username)){
            if (Yii::app()->user->loginAuth($username,$passwd)){
                $remember=intval(Yii::app()->request->getParam('remember','0'));
                Yii::app()->user->login($username,$remember);
                if (empty($url)){
                    header("Location:?r=index/index");
                }else{
                    header("Location:?r={$url}");
                }
            }else{
                $this->render("login",array(
                    'errortype'=>'warning',
                    'message'=>'用户名或密码错误！'
                ));
            }
        }else{
            $this->render("login");
        }

    }

    /**
     * 注销操作
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        header("Location:".LOGIN_URL);
    }
}