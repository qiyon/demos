<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/5/14
 * Time: 8:04 PM
 */

/*
 * devNetConfig.php 文件为不同开发人员自己的独特配置，此文件不应在正式部署时出现，也不应被包含在协作开发中（如svn,git...）
 * 其内容与else部分相似
 */
if(file_exists(__DIR__."/devNetConfig.php")){
    require_once(__DIR__."/devNetConfig.php");
}else{
    $db_connection = "mysql:host=127.0.0.1;dbname=sxdb";
    $db_username = "root";
    $db_passwd = "619619619";

    $loginUrl="?r=index/login";

    //定义时区，中国为PRC
    $time_the_zone="PRC";

    define("DB_CONNECT",$db_connection);
    define("DB_USERNAME",$db_username);
    define("DB_PASSWD",$db_passwd);
    define("LOGIN_URL",$loginUrl);

    if (function_exists("date_default_timezone_set"))
        date_default_timezone_set($time_the_zone);
}
