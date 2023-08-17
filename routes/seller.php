<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//drivers
Route::group(['namespace' => 'api\selleremployees','prefix' => 'seller'],function(){;
Route::post('login','AuthController@login');
Route::post('reset_password','AuthController@reset_password');
Route::post('phone_exist','AuthController@phone_exist');


Route::group(['middleware' => 'auth:selleremployee_api'],function(){
Route::post('change_password','AuthController@change_password');


//orders
Route::get('current_orders','OrderController@current_orders');
Route::get('last_orders','OrderController@last_orders');
Route::get('new_orders','OrderController@new_orders');
Route::get('order_under_excuting','OrderController@order_under_excuting');
Route::post('change_order_status','OrderController@change_order_status');
Route::get('seller_home','OrderController@seller_home');

Route::get('set_seller_status','SellerController@set_seller_status');
});
});