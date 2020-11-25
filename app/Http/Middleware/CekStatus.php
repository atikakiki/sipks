<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        // $users = User::where('email', $request->email)->first();
        // if ($users->role_akun == 3) {
        //     return redirect('/dashboard');
        // } else {
        //     return redirect('/');
        // }

        // return $next($request);
        // if($request->user() && $request->user()->role_akun == '3'){
        //     return $next($request);
        // }

        // return redirect('/')->with('error', 'You have not customer access');

        
            if(Auth::check() && Auth::User()->role_akun=='3'){
                return $next($request);
            }
            return redirect('/')->with('error',"You don't have an access");
        
        
    }

//     public function handle($request, Closure $next, $guard = null)
// {

//     switch($guard){
//         case '3':
//             if (Auth::user($guard)->check()) {
//                 return redirect()->route('/dashboard');
//             }
//         break;

//         default:
//             if (Auth::user($guard)->check()) {
//                 return redirect('/');
//             }
//         break;
//     }
//     return $next($request); //<-- this line :)
// }
}
