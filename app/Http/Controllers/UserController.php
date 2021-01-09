<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 




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

    public function profilePage(){
        
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

        $profile = User::find(auth()->user()->id);

        $data = [
            'auth'=>$auth ,
            'role' => $role ,
            'username' => $name ,
            'user_id' => $user_id , 
            'user_logo' => $user_logo , 
            'pages' => 'Profile' , 
            'profile' => $profile
            
            ] ; 
            

        return view('profilepage' , $data );

    }
    
    public function editProfile(Request $request){

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
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255' ,
            'old_password' => 'required',
            'password' => 'required' ,
            'image_file' => 'nullable|max:10240'
        ]);


        if ($validator->fails()) {      
            
            return back()->with(['failure'=>'Format must match , please check the edit profile form again ! '])->withErrors($validator);
        } else {

           
            $user = User::find($user_id);
            if (!Hash::check($request->get('old_password'), $user->password)) {
                // Success
                return back()->with(['failure'=>'Old Password Incorrect ! ']) ; 

            }

            $validatedData = [
                'username' => $request->get('username') ,
                'password' => bcrypt($request->get('password')) ,
                'image_file' => $request->file('image_file')
            ] ; 
            
            $checker = 0 ; 
            if($validatedData['image_file']){
                $checker = 1 ; 
            }

            $old_image ; 
            $temp_file ;
            if($checker == 1 ){
                $check_file = 'user/'.$validatedData['image_file']->getClientOriginalName() ;
            
                // redirect kalo nama file sudah ada 
                $check_res = User::where('logo', $check_file)->first();
                if($check_res){
                    return back()->with(['failure'=>'File name has already been used by this account ! Enter new unique file name or rename your file']);
                }
                
                $temp_file  = $validatedData['image_file'] ; 
                $old_image = User::select('logo')->where('id', $user_id )->get()->toArray(); // take old file before updated
    
                $validatedData['logo'] = "user/".$validatedData['image_file']->getClientOriginalName() ; 
            }
            
            // var_dump($old_image)  ; die ; 
            unset($validatedData['image_file']);

            $result = User::where('id', $user_id)->update($validatedData);

            //masukin image stlh kita yakin berhasil
            if($result){
                
                //move new file to items/
                if($checker == 1 ){
                    $dst = 'asset/image/user/';
                    $temp_file->move($dst ,$temp_file->getClientOriginalName()) ; 

                    //delete old file 
                    File::delete('asset/image/'. $old_image[0]['logo']);  
                }

                return redirect('/profile')->with(['success'=>'Profile successfully changed']);

            }

            return redirect('/profile')->with(['failure'=>'Something went wrong ! please try again']);

        }

        return redirect('/profile')->with(['failure'=>'Something went wrong  ! please try again']);

    }
   
}