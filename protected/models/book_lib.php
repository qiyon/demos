<?php
/**
 * Created by PhpStorm.
 * User: heqiyon
 * Date: 5/7/14
 * Time: 2:04 PM
 */

class book_lib extends CActiveRecord
{
    public static  function model($className=__CLASS__)
    {
        return parent::model($className);
    }


    public  function tableName()
    {
        return "book_lib";
    }
}