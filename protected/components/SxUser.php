<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/4/14
 * Time: 7:07 PM
 */


/**
 * Class SxUser
 */
class SxUser
{
    public function init(){}

    /**
     * 判断当前用户是否登陆，从session和cookie获取用户名信息来判断
     * 登陆返回ture，未登陆返回false
     * @return bool
     */
    public function isLogined()
    {
        $username="";
        $cookies=Yii::app()->request->getCookies();
        if (isset(Yii::app()->session["sx-username"])){
            $username=Yii::app()->session["sx-username"];
        }elseif(isset($cookies["sx-username"])){
            $username=$cookies["sx-username"];
            Yii::app()->session["sx-username"]=$username;
        }
        if ($username!="")
            return true;
        else
            return false;
    }

    /**
     * 获取当前登陆用户的用户名,未登陆返回空字符串
     * @return string
     */
    public function getUsername()
    {
        $username="";
        $cookies=Yii::app()->request->getCookies();
        if (isset(Yii::app()->session["sx-username"])){
            $username=Yii::app()->session["sx-username"];
        }elseif(isset($cookies["sx-username"])){
            $username=$cookies["sx-username"];
            Yii::app()->session["sx-username"]=$username;
        }

        return $username;
    }

    public function getNickname()
    {
        return $this->getNickByUsername($this->getUsername());
    }

    /**
     * 将用户登陆信息存储到session中，保持登陆则同时存储在cookie中
     *
     * @param $username
     * @param int $remember
     */
    public function login($username,$remember=0)
    {
        if ($remember==1){
            $cookie=new CHttpCookie("sx-username",$username);
            $cookie->expire=time()+60*60*24*7;
            Yii::app()->request->cookies["sx-username"]=$cookie;
        }
        $_SESSION["sx-username"]=$username;
    }

    /**
     * 登陆授权，验证账户密码是否正确
     * @param $username
     * @param $passwd
     * @return bool
     */
    public  function loginAuth($username,$passwd)
    {
        $user_model=user_info::model()->find("username=:username",array(":username"=>$username));
        if ( (!empty($user_model)) && $passwd==$user_model->passwd )
            return true;
        else
            return false;
    }

    /**
     * 注销登陆,删除session和cookie
     */
    public function logout()
    {
        Yii::app()->session["sx-username"]="";
        $cookie=Yii::app()->request->getCookies();
        if (isset($cookie["sx-username"]))
            unset($cookie["sx-username"]);
    }

    public function getNickByUsername($username)
    {
        $user_model=user_info::model()->find("username=:username",array(":username"=>$username));
        if (!empty($user_model)){
            return $user_model->nickname;
        }
    }

    /**
     * 通过用户名获取用户信息，不存在返回-1
     * @param $username
     * @return int
     */
    public function getIdBYUsername($username)
    {
        $user_model=user_info::model()->find("username=:username",array(":username"=>$username));
        if (!empty($user_model)){
            return $user_model->id;
        }else{
            return -1;
        }
    }

    public function getTokenByUsername($username)
    {
        $user_model=user_info::model()->find("username=:username",array(":username"=>$username));
        if (!empty($user_model)){
            return $user_model->token;
        }else{
            return "-1";
        }
    }

    /**
     * 通过userId获取用户名
     * @param $id
     * @return string
     */
    public function getUsernameById($id)
    {
        return "username";
    }

    /**
     * @param $username
     * @return array
     */
    public function getUserInfoByUsername($username)
    {
        $user_model=user_info::model()->find("username=:username",array(":username"=>$username));
        if(!empty($user_model)){
            return array(
                'id'=>$user_model->id,
                'username'=>$user_model->username,
                'nickname'=>$user_model->nickname,
                'isadmin'=>$user_model->isadmin,
                'token'=>$user_model->token,
                'avator'=>"http://202.115.15.3/sxadmin/img/avator.jpg",
            );
        }else{
            return array();
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function getUserInfoById($id)
    {
        return array();
    }


}