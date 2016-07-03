<?php
/**
 * Date: 2016/7/3
 */

header('Content-Type: text/event-stream');
while(true) {
    $sleepSecs = mt_rand(250, 500) / 1000.0;
    usleep($sleepSecs * 1000000);

    $bid = mt_rand(1000, 2000) / 1000.0;
    $t = microtime(true);
    $d = array(
        'timestamp' => gmdate('Y-m-d H:i:s', $t) . sprintf('. %03d', ($t*1000)%1000),
        'symbol' => 'funny',
        'bid' => $bid,
    );

    echo 'data:' . json_encode($d) . PHP_EOL . PHP_EOL;
    @ob_flush(); @flush();
}