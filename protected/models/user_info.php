<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/5/14
 * Time: 8:59 PM
 */

class user_info extends CActiveRecord
{
    public static  function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public  function tableName()
    {
        return "user_info";
    }
}