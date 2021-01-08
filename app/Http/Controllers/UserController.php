<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\Cookie;


class UserController extends Controller
{
    public function homePage(){

        $auth = Auth::check();
        $role = 'guest' ; 
        $name = 'guest' ; 
        $user_id ; 
        $user_logo ; 

        if($auth){
            $role = Auth::user()->role ; // ambil atribut role dari usernya 
            $name = Auth::user()->username ; 
            $user_id = Auth::user()->id ; 
            $user_logo = Auth::user()->logo ; 
        }

        $data = [
            'auth'=>$auth ,
            'role' => $role ,
            'username' => $name ,
            'user_id' => $user_id , 
            'user_logo' => $user_logo , 
            'pages' => 'Home'
            
            ] ; 
            
        return view('homePage' , $data ) ; 
    }
}