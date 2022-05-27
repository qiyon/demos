<?php

class pjson
{
    /**
     * @var bool
     */
    private $legal;

    /**
     * @var string
     */
    private $outJsonStr;

    /**
     * @param string $inputStr
     */
    public function __construct($inputStr)
    {
        $getArr = json_decode($inputStr, true);
        if (!is_array($getArr)) {
            $this->legal = false;
        } else {
            $this->legal = true;
            $this->dumpJson($getArr);
        }
    }

    /**
     * @return bool
     */
    public function isLegal()
    {
        return $this->legal;
    }

    /**
     * @param string $miniStr
     * @param int $loop
     */
    private function addStr($miniStr, $loop = 0)
    {
        while ($loop > 0) {
            $this->outJsonStr .= '    ';
            $loop--;
        }
        $this->outJsonStr .= $miniStr;
    }

    /**
     * @param mixed $getArr
     * @param int $loop
     */
    public function dumpJson($getArr, $loop = 0)
    {
        if (!is_array($getArr)) {
            // number, string, bool
            $this->addStr($this->getTypeStr($getArr));
            return;
        }
        $countIn = 0;
        $countAll = count($getArr);
        if ($getArr === array()) {
            // empty []
            $this->addStr('[]');
            return;
        }
        if (array_keys($getArr) === range(0, $countAll - 1)) {
            // []
            $this->addStr("[\n");
            foreach ($getArr as $value) {
                $this->addStr('', $loop + 1);
                $this->dumpJson($value, $loop + 1);
                if ($countIn != $countAll - 1) $this->addStr(',');
                $this->addStr("\n");
                $countIn++;
            }
            $this->addStr(']', $loop);
        } else {
            // {}
            $this->addStr("{\n");
            foreach ($getArr as $key => $value) {
                $this->addStr('"' . $key . '":', $loop + 1);
                $this->dumpJson($value, $loop + 1);
                if ($countIn != $countAll - 1) $this->addStr(',');
                $this->addStr("\n");
                $countIn++;
            }
            $this->addStr('}', $loop);
        }
    }

    /**
     * @param mixed $var
     * @return string
     */
    private function getTypeStr($var)
    {
        if (is_string($var)) {
            $var = addcslashes($var, "\"\n\r\000");
            return '"' . $var . '"';
        } else if (is_bool($var)) {
            return ($var) ? 'true' : 'false';
        } else if ($var === null) {
            return 'null';
        } else {
            return $var;
        }
    }

    /**
     * @return string
     */
    public function outStr()
    {
        return $this->outJsonStr;
    }
}
