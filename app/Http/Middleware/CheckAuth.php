<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guest()){
            return redirect('/dang-nhap')->with('message', 'Có thể bạn phải đăng nhập.');
        }
        return $next($request);
    }
}
