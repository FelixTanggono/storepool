<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Support\Facades\Cookie;


class AuthController extends Controller
{
    //

    public function landingPage(){

        return view('landingPage' , ['auth' => false , 'role' => 'guest'  ]) ; 
    }
    public function loginPage(){

        // $pages = $this->retrievePages('guest') ; 
        return view('auth/login' , ['auth' => false , 'role' => 'guest' , 'pages' => 'Login'   ]);
    }

    public function registerPage(){
    
        return view('auth/register' , ['auth' => false , 'role' => 'guest' , 'pages' => 'Register' ]);
    }
    public function forgotPasswordPage(){

        // $pages = $this->retrievePages('guest') ; 
        return view('auth/forgotPassword' , ['auth' => false , 'role' => 'guest' , 'pages' => 'Forgot Password' ]);
    }

    public function login(Request $request){
        // buat login function disini 
        $info = $request->only('email' , 'password') ;

        //ngembaliin false or true tergantung apakah user ada di database atau tidak 
        $result = Auth::attempt($info) ; 
        
        $role = 'guest' ;

        if($result){

            $remember = $request->only('remember') ;

            $data = User::select('username')->where('email', $info['email'])->get();

            if(!empty($remember)){

                //cookies ( mengikuti soal )
                $cookie_username = cookie('Username', $data[0]['username'], 120 );
                $cookie_password = cookie('Password', $info['password'], 120 );

                return redirect('/home')->withCookies([$cookie_password , $cookie_username]) ;   
            }
            
            return redirect('/home') ; 
        }else{
            return redirect('/login')->with(['failure'=>'Credentials do not match , please try again !']) ; 
        }
        
       return redirect('/login') ; 

    }

    public function logout(){

     	//logout function 
        Auth::logout() ;
        
        $cookie_username = Cookie::forget('Username');
        $cookie_password = Cookie::forget('Password');
        //ambil asal aja rolenya 
        return redirect('/')->withCookie($cookie_username)->withCookie($cookie_password); 

		// return view('homepage' , ['auth'=> false  , 'role' => 'guest']) ; 

    }    

    public function register(Request $request){

        $validatedData = $request->validate([
            'username' => 'required' ,
            'email' => 'required|email|unique:users' , 
            'password' => 'required|min:3|required_with:password_confirmation' ,
            'confirm_password' => 'required|same:password'
        ]) ;    
        
        $insertData = [
            'username' => $validatedData['username'], 
            'email' => $validatedData['email'], 
            'password' => bcrypt($validatedData['password']), 
            'role' => 'member' , 
            'logo' => 'user/default.jpg'
        ] ; 

        $result = User::create($insertData);

        if($result->exists){
            return redirect('/login')->with(['success'=> 'Thanks for registering !']);
        }

        redirect('/register')->with(['failure'=>'Something went wrong , please try again !']);
        ; 

    }

}
