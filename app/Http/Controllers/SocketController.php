<?php

namespace App\Http\Controllers;


use App\User;
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
        return view('writemessage');
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
