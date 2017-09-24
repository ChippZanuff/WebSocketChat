<?php
/**
 * Created by PhpStorm.
 * User: tes
 * Date: 23.09.17
 * Time: 21:07
 */

namespace app\Http\Middleware;


use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = User::all()->count();
        if (!($user == 1)) {
            if (!Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user does //not have this permission
            {
                abort('401');
            }
        }

        return $next($request);
    }
}