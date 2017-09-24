<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('login', function(\Illuminate\Http\Request $request)
{
    $user = User::where('email', $request->input('email'))->first();
    if(!$user)
    {
        return app(\App\Http\Controllers\Auth\RegisterController::class)->register($request);

        //return Route::redirect('/here', '/there', 301);
    }

    return app(\App\Http\Controllers\Auth\LoginController::class)->login($request);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('socket', 'SocketController@index');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writeMessage');

Route::get('/messages', 'MessageController@index');
Route::resource('users', 'UserController');