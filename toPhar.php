<?php
$stub = "#!/usr/bin/env php" . "\n";

$phar = new Phar('pjson.phar');
$phar->buildFromDirectory(dirname(__FILE__) . '/src/');
$phar->setStub($stub . $phar->createDefaultStub('index.php'));
?>
