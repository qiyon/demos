<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 11:11 AM
 */


class IndexController extends Controller
{
    public $layout="//layouts/adminLayout";
    public function actionIndex(){
        $this->title = "My index";
        $this->render('index');
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
                    header("Location:?r=admin/index/index");
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