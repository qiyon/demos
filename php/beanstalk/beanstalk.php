<?php

require __DIR__.'/vendor/autoload.php';

$producer = (new \Pheanstalk\Pheanstalk('127.0.0.1', 11300))->useTube("TubeDemo");
$producer->put(json_encode(['Type' => '/SendMsgEvent', 'Data' => base64_encode('hhahsajhdjsah')], JSON_UNESCAPED_SLASHES));

$consumer = (new \Pheanstalk\Pheanstalk('127.0.0.1', 11300))->watch("TubeDemo")->ignore('default');
$job = $consumer->reserve(3);
$data = "";
if ($job) {
	$data = $job->getData();
	$consumer->delete($job);
}
echo $data;

