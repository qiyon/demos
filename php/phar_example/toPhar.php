<?php
$stub = <<<SSS
#!/usr/bin/env php
<?php
Phar::mapPhar();
include 'phar://pjson.phar/index.php';
__HALT_COMPILER();
SSS;

$phar = new Phar('pjson.phar', FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, 'pjson.phar');
$phar->buildFromDirectory(dirname(__FILE__) . '/src/');
$phar->setStub($stub);
?>
