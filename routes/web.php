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
Route::get('/','AuthController@landingPage') ; 
Route::get('/forgotPassword','AuthController@forgotPasswordPage') ; 
Route::get('/login','AuthController@loginPage') ;
Route::post('/login','AuthController@login');
Route::get('/register','AuthController@registerPage');
Route::post('/register','AuthController@register') ;
Route::get('/logout','AuthController@logout') ; 

//USER
Route::get('/home','UserController@homePage'); 
Route::get('/profile','UserController@profilePage'); 
Route::post('/profile','UserController@editProfile'); 



//ITEM
Route::get('/item','ItemController@homePage'); 
// Route::get('/shoeDetail/{id}' , 'ItemController@shoeDetail') ;
// Route::get('/addShoe' , 'ItemController@addShoePage');
// Route::post('/addShoe' , 'ItemController@addShoe');
// Route::get('/editShoe/{id}' , 'ItemController@editShoePage');
// Route::post('/editShoe' , 'ItemController@editShoe') ;


// Route::get('/addCart/{id}','TransactionController@addCartPage'); 
// Route::post('/addCart','TransactionController@addCart'); 
// Route::get('/cart','TransactionController@cartPage') ; 
// Route::get('/editCart/{id}','TransactionController@editCartPage') ; 
// Route::post('/editCart','TransactionController@editCart') ; 
// Route::get('/deleteCart/{id}','TransactionController@deleteCart') ; 
// Route::post('/checkoutCart','TransactionController@addTransaction') ; 
// Route::get('/transaction','TransactionController@transactionPage') ; 













