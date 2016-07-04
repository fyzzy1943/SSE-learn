<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('index');
    }

    public function say()
    {
        
    }

    public function flush()
    {
        set_time_limit(0);
        
        header('Content-Type: text/event-stream');
        header('X-Accel-Buffering: no');
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
    }
}
