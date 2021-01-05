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

        $role_id = Role::select('id')->where('name' , $role )->get(); 
        $page_id = Page::select('id')->where('name' , $page )->get(); 
        // echo $role_id . $page_id ;  
        // echo $role_id[0]['id'] ; 

        $result = UserAccess::where('role_id', $role_id[0]['id'])->where('page_id', $page_id[0]['id'])->exists() ; 
        // echo $result ;
        
        if(!$result){
            return redirect('/home')->with(['failure'=>'You do not have access to this page !']); 
        }

        return $next($request);
    }
}
