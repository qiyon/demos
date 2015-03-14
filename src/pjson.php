<?php
class pjson
{
    private $legal;
    private $outJsonStr;

    public function __construct($inputStr)
    {
        $getArr = json_decode($inputStr , true);
        if(empty($getArr) && $getArr !== array()){
            $this->legal = false;
        }else{
            $this->legal = true;
            $this->dumpJson($getArr);
        }
    }

    public function isLegal()
    {
        return $this->legal;
    }

    private function addStr($miniStr , $loop = 0)
    {
        while ($loop > 0 ) {
            $this->outJsonStr .= '    ';
            $loop--;
        }
        $this->outJsonStr .= $miniStr;
    }

    public function dumpJson($getArr , $loop = 0)
    {
        if (!is_array($getArr)){
            //int str bool
            $this->addStr( $this->getTypeStr($getArr));
            return ;
        }
        $countIn = 0;
        $countAll = count($getArr);
        if ($getArr === array()){
            //empty []
            $this->addStr('[]');
            return;
        }
        if (array_keys($getArr) === range(0, $countAll-1)){
            //[]
            $this->addStr("[\n");
            foreach ($getArr as $value) {
                $this->addStr('' , $loop+1);
                $this->dumpJson($value , $loop+1);
                if ( $countIn != $countAll-1 ) $this->addStr(',');
                $this->addStr("\n");
                $countIn++;
            }
            $this->addStr(']' , $loop);
        }else{
            //{}
            $this->addStr("{\n");
            foreach ($getArr as $key => $value) {
                $this->addStr('"'.$key.'":' , $loop+1);
                $this->dumpJson($value , $loop+1);
                if ( $countIn != $countAll-1 ) $this->addStr(',');
                $this->addStr("\n");
                $countIn++;
            }
            $this->addStr('}' , $loop);
        }
    }

    private function getTypeStr($var)
    {
        if (is_int($var)){
            return $var;
        }else if(is_bool($var)){
            return ($var) ? 'true' : 'false';
        }else{
            return '"'.$var.'"';
        }
    }

    public function outStr()
    {
        return $this->outJsonStr . "\n";
    }
}
