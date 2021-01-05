<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class myMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    //request data yg kita send , next tujuan kita aslinya 

    public function handle($request, Closure $next)
    {
        if(!Auth::check()){
            
            return back(); 
        }
        return $next($request);
    }
}
