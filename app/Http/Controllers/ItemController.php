<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Item;




class ItemController extends Controller
{
    
    public function homePage(Request $request){
        
        $keyword = '' ; 
        $keyword = $request->get('search') ;

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

        $item = Item::where('user_id' , $user_id )->paginate(10)->appends(request()->query()); 
        $resultCount = 0 ; 
        
        if($keyword){
            $item =  Item::where('name', 'LIKE', "%$keyword%")->where('user_id' , $user_id )->paginate(10)->appends(request()->query()) ; 
            $resultCount = Item::where('name', 'LIKE', "%$keyword%")->where('user_id' , $user_id )->count() ;    
        }

        // var_dump($item) ; die ; 

        $data = [
                'auth'=>$auth ,
                'role' => $role ,
                'username' => $name ,
                'user_logo' => $user_logo , 
                'item' => $item ,  
                'keyword' => $keyword ,
                'keywordCount' => $resultCount , 
                'pages' => 'Item'

                ] ; 

        return view('itemPage' , $data );
    }
    
    public function addItem(Request $request){

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
            'abuy_price' => 'required|numeric|min:100' ,
            'asell_price' => 'required|numeric|min:100' ,
            'aSKU' => 'required|unique:item,SKU' ,
            'astock' => 'required|numeric|min:0' , 
            'aimage_file' => 'nullable|max:10240'
        ]);

        if ($validator->fails()) {
            return back()->with(['failure'=>'Format must match , please check the add item form again ! '])->withErrors($validator);
        } else {

            $validatedData = [
                'name' => $request->get('aname') ,
                'buy_price' => $request->get('abuy_price') ,
                'sell_price' => $request->get('asell_price') ,
                'SKU' => $request->get('aSKU') ,
                'stock' => $request->get('astock') , 
                'image_file' => $request->file('aimage_file') , 
                'user_id' => $user_id

            ] ; 
            

            $check_file = 'items/'.$validatedData['image_file']->getClientOriginalName() ;
            
            // redirect kalo nama file sudah ada 
            $check_res = Item::where('image', $check_file)->first();
            if($check_res){
                return back()->with(['failure'=>'File name has already been used by this account ! Enter new unique file name or rename your file']);
            }
            
            $temp_file  = $validatedData['image_file'] ; 
        
            $validatedData['image'] = "items/".$validatedData['image_file']->getClientOriginalName() ; 
            unset($validatedData['image_file']);


            $result = Item::create($validatedData) ; 

            //masukin image stlh kita yakin berhasil
            if($result){
                $dst = 'asset/image/items/';
                $temp_file->move($dst ,$temp_file->getClientOriginalName()) ; 

                return redirect('/item')->with(['success'=>'Item succefully added']);

            }

            return redirect('/item')->with(['failure'=>'Something went wrong  ! please try again']);

        }

        return redirect('/item')->with(['failure'=>'Something went wrong  ! please try again']);

    }

    public function deleteItem($id) {

        $filename = Item::select('image')->where('id', $id )->get();
        $result = Item::where('id', $id)->delete();

        
        if($result){ 
            File::delete('asset/image/'.$filename[0]->image);
            return redirect('/item')->with(['success'=> 'Item succesfully deleted!']);
        }

        return back()->with(['failure'=>'Something went wrong , please try again !']);
        

    }

    public function editItem(Request $request){

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

        $id = $request->get('item_id') ; 
        $validator = Validator::make($request->all(), [
            'cname' => 'required|max:255' ,
            'cbuy_price' => 'required|numeric|min:100' ,
            'csell_price' => 'required|numeric|min:100' ,
            'cSKU' => 'required|unique:item,SKU,'.$id ,
            'cstock' => 'required|numeric|min:0' , 
            'cimage_file' => 'nullable|max:10240'
        ]);


        if ($validator->fails()) {
            return back()->with(['failure'=>'Format must match , please check the edit item form again ! ' , 'error_edit' => 1])->withErrors($validator);
        } else {

            $validatedData = [
                'name' => $request->get('cname') ,
                'buy_price' => $request->get('cbuy_price') ,
                'sell_price' => $request->get('csell_price') ,
                'SKU' => $request->get('cSKU') ,
                'stock' => $request->get('cstock') , 
                'image_file' => $request->file('cimage_file') , 
                'user_id' => $user_id

            ] ; 
            
            $checker = 0 ; 
            if($validatedData['image_file']){
                $checker = 1 ; 
            }

            $old_image ; 
            $temp_file ;
            if($checker == 1 ){
                $check_file = 'items/'.$validatedData['image_file']->getClientOriginalName() ;
            
                // redirect kalo nama file sudah ada 
                $check_res = Item::where('image', $check_file)->first();
                if($check_res){
                    return back()->with(['failure'=>'File name has already been used by this account ! Enter new unique file name or rename your file']);
                }
                
                $temp_file  = $validatedData['image_file'] ; 
                $old_image = Item::select('image')->where('id', $id )->get(); // take old file before updated
    
                $validatedData['image'] = "items/".$validatedData['image_file']->getClientOriginalName() ; 
            }
            
            unset($validatedData['image_file']);

            $result = Item::where('id', $id)->update($validatedData);

            //masukin image stlh kita yakin berhasil
            if($result){
                
                //move new file to items/
                if($checker == 1 ){
                    $dst = 'asset/image/items/';
                    $temp_file->move($dst ,$temp_file->getClientOriginalName()) ; 

                    //delete old file 
                    File::delete('asset/image/'. $old_image[0]['image']);  
                }

                return redirect('/item')->with(['success'=>'Item succefully edited']);

            }

            return redirect('/item')->with(['failure'=>'Something went wrong ! please try again']);

        }

        return redirect('/item')->with(['failure'=>'Something went wrong  ! please try again']);

    }

}
