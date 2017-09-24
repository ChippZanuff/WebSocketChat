<?php

namespace App\Http\Controllers;

use app\Message;
use Illuminate\Http\Request;
use Redis;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    public function index()
    {
        $messages = Message::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('message', $messages);
    }

    public function writeMessage(Request $request)
    {
        $ses = $request->session()->all();
        $token = $ses['_token'];

        return view('writemessage', ['_token' => $token]);
    }

    public function sendMessage(Request $request) {
        $this->validate($request, ['message'=>'required|max:200']);
        $message = $request->input('message');
        $userId = $request->input('user_id');

        $data['message'] = $message;
        $data['user_id'] = $userId;
        Message::create($data);

        $redis = Redis::connection();
        $redis->publish('message', $message);

        if($request->isXmlHttpRequest())
        {
            return response('1');
        }

        return redirect()-route('writemessage')-with('flash_message', 'Message successfully delivered.');
    }
}
