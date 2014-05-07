<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 11:12 AM
 */


class IndexController extends Controller
{
    public function actionIndex()
    {
        echo json_encode(array(
            'code'=>0,
            'message'=>"nothing",
        ));
    }

}