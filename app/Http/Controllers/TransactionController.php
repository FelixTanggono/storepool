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
use App\Courier   ;
use App\UserShopAccount;
use App\Marketplace;
use App\UserShop;








class TransactionController extends Controller
{

    public function searchItem(Request $request){
        
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


        $pass_data = $request->all() ; 
        $keyword = $pass_data["keyword"] ; 

        $result = Item::where('SKU', 'like', "%".$keyword."%")->where('user_id' , $user_id )->first()->toArray();
        
		echo json_encode($result) ; 

    }
    
    public function homePage(Request $request){
        
        $transaction_status = $request->query('transaction_status') ;

        if($transaction_status == ''){
            $transaction_status = 'all_order' ; 
        }

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

        // $item = Item::where('user_id' , $user_id )->paginate(10)->appends(request()->query()); 
        // $resultCount = 0 ; 
        
        // if($keyword){
        //     $item =  Item::where('name', 'LIKE', "%$keyword%")->where('user_id' , $user_id )->paginate(10)->appends(request()->query()) ; 
        //     $resultCount = Item::where('name', 'LIKE', "%$keyword%")->where('user_id' , $user_id )->count() ;    
        // }

        // // var_dump($item) ; die ; 

        $user_shop_accounts = []; 

        $user_shops = UserShop::where('user_id',$user_id)->get()->toArray() ;

        foreach($user_shops as $us){

            $user_shop_account = UserShopAccount::where('user_shop_id',$us['id'])->get()->toArray() ; 

            if($user_shop_account){

                foreach($user_shop_account as &$usa ){
                    $res_marketplace = Marketplace::select('name')->where('id' , $usa['marketplace_id'])->get()->toArray() ; 
                    $usa['marketplace_name'] = $res_marketplace[0]['name'] ; 
                    $res_user_shop = UserShop::select('name')->where('id' , $usa['user_shop_id'])->get()->toArray() ; 
                    $usa['user_shop_name'] = $res_user_shop[0]['name'] ; 
        
                }
    
                array_push($user_shop_accounts, $user_shop_account  );
            }
                
            
            
        }

      

        $data = [
                'auth'=>$auth ,
                'role' => $role ,
                'username' => $name ,
                'user_logo' => $user_logo , 
                'pages' => 'Transaction' , 
                'transaction_status' => $transaction_status , 
                'courier' => Courier::all()->toArray() , 
                'user_shop_accounts' => $user_shop_accounts[0]


                // 'item' => $item ,  
                // 'keyword' => $keyword ,
                // 'keywordCount' => $resultCount , 

                ] ; 

        // var_dump($data['user_shop_accounts']) ;   die ; 
        return view('transactionPage' , $data );
    }

}
