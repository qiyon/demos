<?php
$post = file_get_contents('php://input');
$json = json_decode($post, true);
if ($json) {
    file_put_contents('./web.log', json_encode($json, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);
} else {
    file_put_contents('./web.log', '(POST JSON EMPTY): ' . $post . PHP_EOL, FILE_APPEND);
}
echo 'success';
exit();
echo 'error';
header("HTTP/1.0 500 error");
