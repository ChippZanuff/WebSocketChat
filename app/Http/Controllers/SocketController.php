<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class socketController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('socket');
    }

    public function writeMessage(Request $request)
    {
        $ses = $request->session()->all();
        $token = $ses['_token'];
        return view('writemessage', ['_token' => $token]);
    }

    public function sendMessage(Request $request) {
        $redis = Redis::connection();
        $redis->publish('message', $request->input('message'));

        if($request->isXmlHttpRequest())
        {
            return response('1');
        }

        return redirect('writemessage');
    }
}
