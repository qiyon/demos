#!/usr/bin/env php
<?php
require( __DIR__.'/pjson.php');

$stdinStr = "";
while (!feof(STDIN)){
    $stdinStr .= fgets(STDIN); 
}
$pj = new pjson($stdinStr);
if ($pj->isLegal()){
    echo $pj->outStr();
}else{
    echo "Invalid json string:\n";
    echo $stdinStr;
}