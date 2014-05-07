<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 11:44 AM
 */

class SxuserController extends Controller
{
    public function actionIndex()
    {
        echo json_encode(array(
            "code"=>0,
        ));
    }


    public function actionLogin()
    {
        $username=Yii::app()->request->getParam("username");
        $passwd=Yii::app()->request->getParam("passwd");

        if ($username=="admin"&&$passwd=="admin"){
            echo json_encode(array(
                "code"=>0,
                "token"=>md5("admin"),
            ));
        }else{
            echo json_encode(array(
                'code'=>-1,
                "message"=>"wrong!",
            ));
        }
    }
}