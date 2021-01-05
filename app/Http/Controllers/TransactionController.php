<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;
use App\CartDetail;
use App\CartHeader;
use App\TransactionHeader;
use App\TransactionDetail   ;




class TransactionController extends Controller
{
    //

    // public function addCartPage($id){

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

    //     return view('addCartPage',$data );
    // }

    // public function addCart(Request $request){

    //     $item_id = $request->post('item_id') ; 
    //     $validatedData = $request->validate([
    //         'qty' => 'required|numeric|min:1' ,
    //     ]) ;

    //     $user_id = Auth::user()->id ;  

    //     if(!CartHeader::where('user_id' , $user_id)->exists() ){
    //         CartHeader::create(['user_id' => $user_id]) ; 
    //     }
        
    //     $cartheader = CartHeader::where('user_id' , $user_id)->first() ; 
    //     $cartheader_id = $cartheader->id ; 

    //     $insertData = [
    //         'cart_header_id' => $cartheader_id , 
    //         'item_id' => $item_id , 
    //         'qty' => $validatedData['qty']
    //     ] ; 

    //     $result = ''; 

    //     //kalo ada cart detail dengan item dan header sama
    //     if(!CartDetail::where('item_id' , $item_id)->where('cart_header_id' , $cartheader_id)->exists()){
    //         $result = CartDetail::create($insertData);
    //     }else{
    //         $result = CartDetail::where('item_id' , $item_id)->where('cart_header_id' , $cartheader_id)->first() ; 
    //         $curr_qty = $result->qty ; 
    //         $result = CartDetail::where('item_id' , $item_id)
    //                             ->where('cart_header_id' , $cartheader_id)
    //                             ->update(['qty' => $curr_qty + $validatedData['qty']]);
                                

    //     }

        
    //     if($result){ 

    //         return redirect('/home')->with(['success'=> 'Item added to cart !']);
    //     }

    //     return back()->with(['failure'=>'Something went wrong , please try again !']);

    // }

    // public function cartPage(){


    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 

    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //     }

    //     $pages = $this->retrievePages($role) ; 

    //     $user_id = Auth::user()->id ;  
    //     $cart_header = CartHeader::where('user_id' , $user_id)->first() ; 

    //     $cart = [] ; 

    //     if($cart_header){
    //         $cartheader_id = $cart_header->id ; 
    //         $cart = CartDetail::where('cart_header_id' , $cartheader_id)->get()->toArray() ;
    
    //         foreach ( $cart as &$c ) {
                
    //             $temp_res = Item::where('id' , $c['item_id'] )->get()->toArray() ;
    //             $c['shoe'] = $temp_res[0] ; 
    //             $c['shoe']['total_price'] = $c['shoe']['price'] * $c['qty'] ; 
    //         } 
    //     }
      

    //     $data = [
    //         'auth'=>$auth ,
    //         'role' => $role ,
    //         'username' => $name ,
    //         'cart' => $cart ,
    //         'pages' => $pages 
    //         ] ; 


    //     return view('cartPage',$data );
    // }
 
    // public function editCartPage($id){

    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 

    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //     }

    //     $pages = $this->retrievePages($role) ; 

    //     $cart = CartDetail::where('id' , $id)->first() ;
    //     $temp_res = Item::where('id' , $cart['item_id'] )->get()->toArray() ;
    //     $cart['shoe'] = $temp_res[0] ; 
    //     $cart['total_price'] = $cart['shoe']['price'] * $cart['qty'] ;

        
    //     $data = [
    //         'auth'=>$auth ,
    //         'role' => $role ,
    //         'username' => $name ,
    //         'cart' => $cart ,
    //         'pages' => $pages 
    //         ] ; 


    //     return view('editCartPage',$data );

    // }

    // public function editCart(Request $request){

    //     $id = $request->post('cart_detail_id') ; 
    //     $validatedData = $request->validate([
    //         'qty' => 'required|numeric|min:1' ,
    //     ]) ;

        
    //     $result = CartDetail::where('id', $id)->update(array('qty' => $validatedData['qty']));

        
    //     if($result){ 

    //         return redirect('/cart')->with(['success'=> 'Cart succesfully changed!']);
    //     }

    //     return back()->with(['failure'=>'Something went wrong , please try again !']);
    
    // }

    // public function deleteCart($id) {

       
    //     $result = CartDetail::where('id', $id)->delete();

        
    //     if($result){ 

    //         return redirect('/cart')->with(['success'=> 'Cart succesfully deleted!']);
    //     }

    //     return back()->with(['failure'=>'Something went wrong , please try again !']);
        

    // }

    // public function addTransaction(Request $request){

    //     $cart_detail_ids = $request->post('cart_detail_id') ; 

    //     if(!empty($cart_detail_ids)){

    //         $auth = Auth::check();
    //         $user_id ; 
    //         if($auth){
    //             $user_id = Auth::user()->id ; // ambil atribut role dari usernya 
    //         }

    //         $total_price = 0 ; 
    //         foreach($cart_detail_ids as $cid ){
    //             $cart_detail = CartDetail::where('id' , $cid )->first() ; 
    //             $item = Item::where('id' , $cart_detail->item_id )->first() ; 
    //             $total_price += $item->price * $cart_detail->qty ; 
    //         }

    //         $insert_header = [
    //             'user_id' => $user_id , 
    //             'total_price' => $total_price , 
    //         ] ; 

    //         $result_header = TransactionHeader::create($insert_header);
            
    //         if($result_header){

    //             foreach($cart_detail_ids as $cid ){

    //                 $cart_detail = CartDetail::where('id' , $cid )->first() ; 

    //                 $insert_detail = [
    //                     'transaction_header_id' => $result_header->id , 
    //                     'item_id' => $cart_detail->item_id , 
    //                     'qty' => $cart_detail->qty , 
    //                 ] ; 

    //                 $result_detail = TransactionDetail::create($insert_detail);

    //                 CartDetail::where('id', $cid)->delete();

    //             }

    //             CartHeader::where('user_id', $user_id)->delete();



    //             return redirect('/home')->with(['success'=> 'Checkout successful!']);
    //         }

    //         return back()->with(['failure'=>'Something went wrong , please try again !']);

    //     }

    //     return back()->with(['failure'=>'Please fill the cart !']);
        
    // }

    // public function transactionPage(){

    //     $auth = Auth::check();
    //     $role = 'guest' ; 
    //     $name = 'guest' ; 
    //     $id ; 
    //     $transaction = [] ; 

    //     if($auth){
    //         $role = Auth::user()->role ; // ambil atribut role dari usernya 
    //         $name = Auth::user()->username ; 
    //         $user_id = Auth::user()->id ; 
    //     }

    //     $pages = $this->retrievePages($role) ; 

    //     if($role == 'member'){

    //         $transaction = TransactionHeader::where('user_id' , $user_id)->get()->toArray() ;

    //         foreach($transaction as &$t ){
    //             $t['detail'] = TransactionDetail::where('transaction_header_id' , $t['id'] )->get()->toArray(); 

    //             foreach ( $t['detail'] as &$td ) {
                
    //                 $temp_res = Item::where('id' , $td['item_id'] )->get()->toArray() ;
    //                 $td['shoe'] = $temp_res[0] ;
                     
    //             } 
    //         }
           

    //     }else if ( $role == 'admin'){

    //         $transaction = TransactionHeader::all()->toArray() ;

    //         foreach($transaction as &$t ){
    //             $t['detail'] = TransactionDetail::where('transaction_header_id' , $t['id'] )->get()->toArray(); 

    //             foreach ( $t['detail'] as &$td ) {
                
    //                 $temp_res = Item::where('id' , $td['item_id'] )->get()->toArray() ;
    //                 $td['shoe'] = $temp_res[0] ;
                     
    //             } 
    //         }
    //     }

    
       
    //     // var_dump($transaction) ; die ; 

    //     $data = [
    //         'auth'=>$auth ,
    //         'role' => $role ,
    //         'username' => $name ,
    //         'transaction' => $transaction ,
    //         'pages' => $pages 
    //         ] ; 


    //     return view('transactionPage',$data );
    // }

}
