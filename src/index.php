<?php
class pjson
{
    private $legal;
    private $outJsonStr;

    public function __construct($inputStr)
    {

    }

    public function isLegal()
    {

    }

    public function outStr()
    {

    }

    public static function strFromStdin()
    {
        $getStr = "";
        while (!feof(STDIN)){
            $getStr .= fgets(STDIN); 
        }
        return $getStr;
    }
}


$getArr = json_decode(pjson::strFromStdin() , true);
print_r($getArr);
