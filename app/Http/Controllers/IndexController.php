<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $global = 3;

    public function __construct()
    {
    }

    public function index()
    {
        return view('index');
    }

    public function say(Request $request)
    {
        Redis::set('name', $request->get('in'));

        return Redis::get('name');
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
                'global'=>Redis::get('name'),
            );

            echo 'data:' . json_encode($d) . PHP_EOL . PHP_EOL;
            @ob_flush(); @flush();
        }
    }
}
