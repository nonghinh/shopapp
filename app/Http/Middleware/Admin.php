<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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

        if(Auth::user()->level < 2){
            return redirect('/')->with('message', 'Bạn không thể truy cập vào đường dẫn đó.');
        }
        return $next($request);
    }
}
