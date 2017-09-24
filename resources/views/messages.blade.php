@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(isset($messages))
                    @foreach ($messages as $message)
                        <div class="panel-body">
                            <div class="msg-body">
                                <p class="nickname">
                                    {{$nickname}}
                                </p>
                                <p class="message">
                                    {{$message}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="text-center">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection