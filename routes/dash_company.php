<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//drivers
Route::group(['namespace' => 'CompanyDashboard\Auth','prefix' => 'companydashboard'],function(){
    Route::get('companylogin','LoginController@index')->name('companylogin');
Route::post('postcompanylogin','LoginController@login')->name('postcompanylogin');
});
Route::group(['middleware' => 'auth:driver','prefix' => 'companydashboard','namespace' => 'CompanyDashboard'],function(){

Route::get('companylogout','Auth\LoginController@companylogout')->name('companylogout');


Route::resource('company_captions', 'DriverController');

Route::get('your_orders', 'OrderController@index')->name("your_orders.index");

Route::post('choose_your_driver', 'OrderController@choose_your_driver')->name("your_orders.choose_your_driver");

});

