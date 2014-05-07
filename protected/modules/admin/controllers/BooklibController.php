<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 2:07 PM
 */


class BooklibController extends Controller
{
    public $layout="//layouts/adminLayout";

    /**
     * 更改视图路径到../view/下
     */
    public function getViewPath()
    {
        return $this->getModule()->getViewPath();
    }


    public function actionIndex()
    {
        $this->render("booklib");
    }

    public function actionAddbook()
    {

    }
}


