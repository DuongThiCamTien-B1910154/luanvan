<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth::check()) {
            // $user = auth::user();
            if (auth::User()->level == '0' || auth::User()->level == '1'|| auth::User()->level == '2') {
                return $next($request);
            } else {
                return redirect()->route('login')->with('error', 'Tài khoản không hợp lệ!');
            }
        } else {

            return redirect('login')->with('error', 'Tài khoản không hợp lệ!');
        }
    }
}
