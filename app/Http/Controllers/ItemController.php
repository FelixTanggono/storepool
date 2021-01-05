<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;




class ItemController extends Controller
{
    // //

    // public function homePage(Request $request){
        
    //     $keyword = '' ; 
    //     $keyword = $request->get('search') ;

    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 


    //     $bannerShoe = Item::all()->take(3);
    //     $shoes = Item::paginate(6)->appends(request()->query()); 
    //     $resultCount = '' ; 
        
    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //     }

    //     if($keyword){
    //         $shoes =  Item::where('name', 'LIKE', "%$keyword%")->paginate(6)->appends(request()->query()) ; 
    //         $resultCount = Item::where('name', 'LIKE', "%$keyword%")->count() ;    
    //     }

    //     $pages = $this->retrievePages($role) ; 
        
    //     // var_dump($role) ; 
    //     $data = [
    //             'auth'=>$auth ,
    //             'role' => $role ,
    //             'username' => $name ,
    //             'shoes' => $shoes ,
    //             'pages' => $pages ,
    //             'bannerShoe'=>$bannerShoe ,
    //             'keyword' => $keyword ,
    //             'keywordCount' => $resultCount
    //             ] ; 
    //     // var_dump($shoes) ; die ; 

    //     return view('homePage', $data );
    // }

    
    // public function shoeDetail($id){

    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 

    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //     }

    //     $pages = $this->retrievePages($role) ; 


    //     $shoe = Item::where('id', $id )->get()->toArray() ; 
    //     $shoe = $shoe[0] ; 

    //     $data = [
    //         'auth'=>$auth ,
    //         'role' => $role ,
    //         'username' => $name ,
    //         'shoe' => $shoe ,
    //         'pages' => $pages 
    //         ] ; 

    //     return view('shoeDetail',$data );
    // }

    // public function addShoePage(){

    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 

    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //     }

    //     $pages = $this->retrievePages($role) ; 



    //     $data = [
    //         'auth'=>$auth ,
    //         'role' => $role ,
    //         'username' => $name ,
    //         'pages' => $pages 
    //         ] ; 

    //     return view('addShoePage',$data );
    // }

    // public function addShoe(Request $request){

    //     $validatedData = $request->validate([
    //         'name' => 'required' ,
    //         'price' => 'required|numeric|min:100' ,
    //         'description' => 'required' ,
    //         'image_file' => 'required' , 
    //     ]) ;


    //     $check_file = 'shoes/'.$validatedData['image_file']->getClientOriginalName() ; 
    //     $check_res = Item::where('image', $check_file)->first();
    //     if($check_res){
    //         return back()->with(['failure'=>'File name has already been used ! Enter new unique file name']);
    //     }

    //     $temp_file  = $validatedData['image_file'] ; 
       
    //     $validatedData['image'] = "shoes/".$validatedData['image_file']->getClientOriginalName() ; 
    //     unset($validatedData['image_file']);

    //     var_dump($validatedData) ; 

    //     $result = Item::create($validatedData) ; 

    //     //masukin image stlh kita yakin berhasil
    //     if($result){
    //         $dst = 'asset/image/shoes/';
    //         $temp_file->move($dst ,$temp_file->getClientOriginalName()) ; 

    //         return redirect('/home')->with(['success'=>'Shoe succefully added']);

    //     }

    //     return redirect('/home')->with(['failure'=>'Something went wrong  ! please try again']);

    // }

    // public function editShoePage($id){

    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 

    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //     }

    //     $pages = $this->retrievePages($role) ; 


    //     $shoe = Item::where('id', $id )->get()->toArray() ; 
    //     $shoe = $shoe[0] ; 

    //     $data = [
    //         'auth'=>$auth ,
    //         'role' => $role ,
    //         'username' => $name ,
    //         'shoe' => $shoe ,
    //         'pages' => $pages 
    //         ] ; 

    //     return view('editShoePage',$data );
    // }

    // public function editShoe(Request $request){

    //     $validatedData = $request->validate([
    //         'name' => 'required' ,
    //         'price' => 'required|numeric|min:100' ,
    //         'description' => 'required' ,
    //     ]) ;
        
    //     $validatedData['price'] = intval($validatedData['price'] ) ; 

    //     $image_file = $request->file('image_file') ; 
    //     $item_id = $request->only('shoe_id') ; 


    //     $old_image = Item::where('id', $item_id['shoe_id'])->get()->toArray();  

    //     if($image_file){
            
    //         var_dump($image_file->getClientOriginalName())  ;  
    //         $check_file = 'shoes/'.$image_file->getClientOriginalName() ; 
    //         $check_res = Item::where('image', $check_file)->first();
    //         if($check_res){
    //             return back()->with(['failure'=>'File name has already been used ! Enter new unique file name']);
    //         }

    //         $validatedData['image'] = "shoes/".$image_file->getClientOriginalName() ; 

    //     }


    //     $result = Item::where('id', $item_id['shoe_id'])->update($validatedData);

    //     if($result){
    //         if($image_file){
    //             $dst = 'asset/image/shoes/';
    //             $image_file->move($dst ,$image_file->getClientOriginalName()) ; 
                
    //             File::delete('asset/images/'. $old_image[0]['image']);  

    //         }

    //         return redirect('/home')->with(['success'=>'Shoe succefully edited']);

    //     }

    //     return redirect('/home')->with(['failure'=>'Something went wrong  ! please try again']);

    // }



}
