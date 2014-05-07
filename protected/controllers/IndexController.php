<?php
class IndexController extends Controller{

    public  $layout=false;
    /**
     * 后台主页面
     */
    public function actionIndex(){
        $this->title = "My index";
        $this->render('index');
    }

    /**
     * 登陆界面
     */
}
