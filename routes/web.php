<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// setiap akses ke route ini akan dikenakan middleware mymid 12
// Route::group(['middleware'=>'myMid'] , function() {

// }) ; 



// AUTH
Route::get('/','AuthController@landingPage')->middleware('checkAccess:landing_page') ; 
Route::get('/forgotPassword','AuthController@forgotPasswordPage')->middleware('checkAccess:auth') ; 
Route::get('/login','AuthController@loginPage')->middleware('checkAccess:auth') ; 
Route::post('/login','AuthController@login')->middleware('checkAccess:auth') ; 
Route::get('/register','AuthController@registerPage')->middleware('checkAccess:auth') ; 
Route::post('/register','AuthController@register')->middleware('checkAccess:auth') ; 
Route::get('/logout','AuthController@logout')->middleware('checkAccess:logout') ; 

//USER
Route::get('/home','UserController@homePage')->middleware('checkAccess:user') ; 
Route::get('/profile','UserController@profilePage')->middleware('checkAccess:user') ; 
Route::post('/editProfile','UserController@editProfile')->middleware('checkAccess:user') ; 

//ITEM
Route::get('/item','ItemController@homePage')->middleware('checkAccess:item') ; 
Route::post('/addItem','ItemController@addItem')->middleware('checkAccess:item') ; 
Route::get('/deleteItem/{id}','ItemController@deleteItem')->middleware('checkAccess:item') ; 
Route::post('/editItem','ItemController@editItem')->middleware('checkAccess:item') ; 

//TRANSACTION
Route::get('/transaction','TransactionController@homePage')->middleware('checkAccess:transaction') ;  
Route::post('/transaction/searchItem','TransactionController@searchItem')->middleware('checkAccess:transaction') ;
// Route::get('/transactionContent/{status}','TransactionController@transactionContent'); 

//SHOP
Route::get('/shop','ShopController@homePage')->middleware('checkAccess:shop') ;
Route::post('/addShop', 'ShopController@addShop')->middleware('checkAccess:shop') ;
Route::get('/deleteShop/{id}', 'ShopController@deleteShop')->middleware('checkAccess:shop') ;
Route::post('/editShop', 'ShopController@editShop')->middleware('checkAccess:shop') ;

//SHOP ACCOUNT 
//belum sempat ngerjain 
 

















