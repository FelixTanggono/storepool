<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;
use App\Page;
use App\Role;
use App\UserAccess;


class checkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $page )
    {
        $auth = Auth::check();
        $role = 'guest' ; 
        $name = 'guest' ; 

        if($auth){
            $role = Auth::user()->role ; // ambil atribut role dari usernya 
        }

        $guestPageAccess = array("landing_page" , "auth") ; 
        $memberPageAccess = array("user" , "item" , "transaction" , "shop" , 'logout') ; 

        if($role == "guest"){
            //role guest 
            if(!in_array($page, $guestPageAccess)){
                return redirect('/')->with(['failure'=>'You do not have access to this page !']); 
            }

        }else{
            // role member
            
            if(!in_array($page, $memberPageAccess)){
                return redirect('/home')->with(['failure'=>'You do not have access to this page !']); 
            }

        }

        return $next($request);
    }
}
