@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Send message</div>
                    <div class="msg-post">
                        {{ csrf_field()}}
                        <input type="hidden" name="action" value="{{ action('SocketController@sendMessage') }}">
                        <input type="text" name="message" title="message input">
                        <button id="ajaxbtn" type="submit">Send</button>
                    </div>



                </div>
            </div>
        </div>
    </div>

@endsection