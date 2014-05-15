<?php
class IndexController extends Controller{

    public  $layout="//layouts/homeLayout";

    /**
     * 后台主页面
     */
    public function actionIndex(){
        $this->title = "捐助查询";
        $this->render('index');
    }

}
