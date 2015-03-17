<?php
require( dirname(__FILE__) . '/pjson.php');

$stdinStr = "";
while (!feof(STDIN)){
    $stdinStr .= fgets(STDIN); 
}
$pj = new pjson($stdinStr);
if ($pj->isLegal()){
    echo $pj->outStr() . "\n";
}else{
    echo "Invalid json string:\n";
    echo $stdinStr;
}