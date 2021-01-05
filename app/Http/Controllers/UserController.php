<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\Cookie;


class UserController extends Controller
{
    public function homePage(){

        return view('homePage' , ['auth' => false , 'role' => 'member'  ]) ; 
    }
}