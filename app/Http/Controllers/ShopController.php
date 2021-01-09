<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use App\User;
use Illuminate\Support\Facades\Cookie;

use App\UserShop;


class ShopController extends Controller
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

        $user_shop = [] ; 
        $user_shop = UserShop::where('user_id' , $user_id )->get()->toArray()  ; 

        $data = [
            'auth'=>$auth ,
            'role' => $role ,
            'username' => $name ,
            'user_id' => $user_id , 
            'user_logo' => $user_logo , 
            'pages' => 'Shop' , 
            'user_shop' => $user_shop             
            ] ; 
            
        return view('shopPage' , $data ) ; 
    }

    public function addShop(Request $request){

        $auth = Auth::check();
        $role = 'guest' ; 
        $name = 'guest' ; 
        $user_id ; 
        $user_logo ; 

        // echo 'haha' ; die ; 
        if($auth){
            $role = Auth::user()->role ; // ambil atribut role dari usernya 
            $name = Auth::user()->username ; 
            $user_id = Auth::user()->id ; 
            $user_logo = Auth::user()->logo ; 
        }

        $validator = Validator::make($request->all(), [
            'aname' => 'required|max:255' ,
            'aimage_file' => 'required|max:10240'
        ]);

        if ($validator->fails()) {
            return back()->with(['failure'=>'Format must match , please check the add shop form again ! '])->withErrors($validator);
        } else {

            $validatedData = [
                'name' => $request->get('aname') ,
                'image_file' => $request->file('aimage_file') , 
                'created_at' => now() ,
                'user_id' => $user_id   
            ] ; 
            

            $check_file = 'user_shop/'.$validatedData['image_file']->getClientOriginalName() ;
            
            // redirect kalo nama file sudah ada 
            $check_res = UserShop::where('logo', $check_file)->first();
            if($check_res){
                return back()->with(['failure'=>'File name has already been used by this account ! Enter new unique file name or rename your file']);
            }
            
            $temp_file  = $validatedData['image_file'] ; 
        
            $validatedData['logo'] = "user_shop/".$validatedData['image_file']->getClientOriginalName() ; 
            unset($validatedData['image_file']);


            $result = UserShop::create($validatedData) ; 

            //masukin image stlh kita yakin berhasil
            if($result){
                $dst = 'asset/image/user_shop/';
                $temp_file->move($dst ,$temp_file->getClientOriginalName()) ; 

                return redirect('/shop')->with(['success'=>'Shop succefully added']);

            }

            return redirect('/shop')->with(['failure'=>'Something went wrong  ! please try again']);

        }

        return redirect('/shop')->with(['failure'=>'Something went wrong  ! please try again']);

    }


    public function deleteShop($id) {

        $filename = UserShop::select('logo')->where('id', $id )->get();
        $result = UserShop::where('id', $id)->delete();

        
        if($result){ 
            File::delete('asset/image/'.$filename[0]->image);
            return redirect('/shop')->with(['success'=> 'Shop succesfully deleted!']);
        }

        return back()->with(['failure'=>'Something went wrong , please try again !']);
        

    }

    public function editShop(Request $request){

        $auth = Auth::check();
        $role = 'guest' ; 
        $name = 'guest' ; 
        $user_id ; 
        $user_logo ; 

        // echo 'haha' ; die ; 
        $id = $request->get('shop_id') ; 

        if($auth){
            $role = Auth::user()->role ; // ambil atribut role dari usernya 
            $name = Auth::user()->username ; 
            $user_id = Auth::user()->id ; 
            $user_logo = Auth::user()->logo ; 
        }

        $validator = Validator::make($request->all(), [
            'cimage_file' => 'nullable|max:10240'
        ]);

        if ($validator->fails()) {
            return back()->with(['failure'=>'Format must match , please check the edit shop form again ! '])->withErrors($validator);
        } else {

            $validatedData = [
                'image_file' => $request->file('cimage_file') , 
            ] ; 

            $checker = 0 ; 
            if($validatedData['image_file']){
                $checker = 1 ; 
            }

            $old_image ; 
            $temp_file ;
            if($checker == 1 ){

                $check_file = 'user_shop/'.$validatedData['image_file']->getClientOriginalName() ;
            
                // redirect kalo nama file sudah ada 
                $check_res = UserShop::where('logo', $check_file)->first();
                if($check_res){
                    return back()->with(['failure'=>'File name has already been used by this account ! Enter new unique file name or rename your file']);
                }
                
                $temp_file  = $validatedData['image_file'] ; 
                $old_image = UserShop::select('logo')->where('id', $id )->get(); // take old file before updated
    
                $validatedData['logo'] = "user_shop/".$validatedData['image_file']->getClientOriginalName() ; 
            }
                    
            unset($validatedData['image_file']);


            $result = UserShop::where('id', $id)->update($validatedData);

            //masukin image stlh kita yakin berhasil
            if($result){

                if($checker == 1 ){
                    $dst = 'asset/image/user_shop/';
                    $temp_file->move($dst ,$temp_file->getClientOriginalName()) ; 

                    //delete old file 
                    File::delete('asset/image/'. $old_image[0]['image']);  
                }

                return redirect('/shop')->with(['success'=>'Shop succefully edited']);


            }

            return redirect('/shop')->with(['failure'=>'Something went wrong  ! please try again']);

        }

        return redirect('/shop')->with(['failure'=>'Something went wrong  ! please try again']);

    }
   
}