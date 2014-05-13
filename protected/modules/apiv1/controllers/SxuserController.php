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


    /**
     * API:
     * in:username,passwd
     * out:json,登陆信息
     */
    public function actionLogin()
    {
        $username=Yii::app()->request->getParam("username");
        $passwd=Yii::app()->request->getParam("passwd");

        if (Yii::app()->user->loginAuth($username,$passwd)){
            $uid=Yii::app()->user->getIdByUsername($username);
            $userToken=Yii::app()->user->getTokenByUsername($username);
            $userInfo=Yii::app()->user->getUserInfoByUsername($username);
            if ($userToken=="-1"){
                echo json_encode(array(
                    "code"=>-1,
                    "message"=>"wrong!",
                ));
            }
            echo json_encode(array(
                "code"=>0,
                "token"=>$uid.'_'.$userToken,
                "username"=>$userInfo["username"],
                "nickname"=>$userInfo["nickname"],
                "isadmin"=>($userInfo["isadmin"])?true:false,
                "avator"=>$userInfo["avator"],
                "null"=>"",
            ));
        }else{
            echo json_encode(array(
                'code'=>-1,
                "message"=>"wrong!",
            ));
        }
    }

    /**
     * 根据token获取用户信息
     */
    public function actionGetinfo()
    {
        $id_token=Yii::app()->request->getParam("token",'');
        if (empty($id_token)){
            return;
        }
        $userInfo=Yii::app()->user->getInfoByApiToken($id_token);
        if (!empty($userInfo) ){
            echo json_encode( array(
                "code"=>0,
                "token"=>$userInfo["id"].'_'.$userInfo["token"],
                "username"=>$userInfo["username"],
                "nickname"=>$userInfo["nickname"],
                "isadmin"=>($userInfo["isadmin"])?true:false,
                "avator"=>$userInfo["avator"],
            ));
        }else{
            echo json_encode(array(
                'code'=>-1,
                'message'=>'获取信息失败',
            ));
        }

    }
}