<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'api'],function(){
Route::get("tokeninvalid","AuthController@tokeninvalid")->name("tokeninvalid");
Route::get('login_countries','AuthController@login_countries');
Route::post('register','AuthController@register');
Route::post('login','AuthController@login');
Route::post('reset_password','AuthController@reset_password');
Route::post('phone_exist','AuthController@phone_exist');
//rates
Route::post('sellersrates','SellerRateController@sellersrates');
Route::get('online_voucher','CouponController@online_voucher');
Route::get('questions','QuestionController@index');
Route::post('search_sellers','SearchSellerController@search_sellers');
// central sellers
Route::post('get_central_sellers','CentralSellerController@get_central_sellers');
// menu types
Route::post('fetch_menu_types','MenuTypeController@fetch_menu_types');
// men type items
Route::post('fetch_menu_type_items','MenuTypeController@fetch_menu_type_items');

Route::post('seller_menu','SellerItemController@seller_menu');

Route::post('seller_payment_methods','SellerPaymentMethodController@seller_payment_methods');

Route::group(['middleware' => 'auth:api'],function(){
Route::get('verify_phone','AuthController@verify_phone');
Route::post('change_password','AuthController@change_password');
Route::post('change_info','AuthController@change_info');
Route::post('set_location','AuthController@set_location');
Route::post('add_to_cart','CartController@add_to_cart');
Route::post('remove_cart_item','CartController@remove_cart_item');
Route::post('edit_cart_item_count','CartController@edit_cart_item_count');
Route::post('my_cart','CartController@my_cart');
Route::post('check_coupon','CouponController@check_coupon');
Route::post('send_order','OrderController@send_order');
Route::post('addsellerrate','SellerRateController@addsellerrate');
Route::post('favorite_seller','FavoriteSellerController@favorite_seller');
Route::get('your_favorite_sellers','FavoriteSellerController@your_favorite_sellers');
Route::post('deletesellerrate','SellerRateController@deletesellerrate');
Route::get('current_orders','CurrentOrderController@current_orders');
Route::get('last_orders','CurrentOrderController@last_orders');
Route::post('add_free_orders','FreeOrderController@add_free_orders');
Route::post('change_notify_status','AuthController@change_notify_status');
Route::post('rate_order','OrderRateController@rate_order');
Route::post('save_cart','SavedCartController@save_cart');
Route::get('saved_carts','SavedCartController@saved_carts');
Route::post('cancel_order','OrderController@cancel_order');
Route::post('add_address','AddressController@add_address');
Route::post('active_address','AddressController@active_address');
Route::get('your_addresses','AddressController@your_addresses');
Route::get('your_active_addresses','AddressController@your_active_addresses');
Route::get('wallet_amount','WallletController@wallet_amount');
Route::get('your_notifications','NotificationController@your_notifications');

});
Route::post('zones','ZoneController@index');
Route::post('fetch_majors','MajorController@fetch_majors');
Route::post('fetch_home_adds','MajorController@fetch_home_adds');
Route::post('major_classifications','MajorController@major_classifications');
Route::post('major_adds','MajorController@major_adds');
Route::post('closest_sellers','SellerController@closest_sellers');
Route::post('item_details','ItemController@item_details');
Route::post('major_shops','SellerController@major_shops');
Route::post('seller_categories','ItemController@seller_categories');
Route::post('seller_subcategories','ItemController@seller_subcategories');
Route::post('seller_tags','SellerController@seller_tags');
Route::post('home_content','MajorController@home_content');
Route::post('majorclassifications','MajorClassificationapiController@majorclassifications');
Route::post('majorclassificationsellers','MajorClassificationapiController@majorclassificationsellers');
Route::post('majorclassificationsads','MajorClassificationapiController@majorclassificationsads');
Route::post('majorclassificationscontent','MajorClassificationapiController@majorclassificationscontent');
Route::post('searchitemseller','ItemController@searchitemseller');
Route::post('searchitems','ItemController@searchitems');
});
//selleremployee
Route::group(['namespace' => 'api\selleremployees','prefix' => 'selleremployee'],function(){;
Route::post('login','AuthController@login');
Route::post('reset_password','AuthController@reset_password');
Route::group(['middleware' => 'auth:selleremployee_api'],function(){
Route::post('change_password','AuthController@change_password');

});
});
//drivers
Route::group(['namespace' => 'api\drivers','prefix' => 'drivers'],function(){;
Route::post('login','AuthController@login');
Route::post('reset_password','AuthController@reset_password');
Route::post('phone_exist','AuthController@phone_exist');

Route::get('fetch_problem_reasons','ProblemReasonController@fetch_problem_reasons');

Route::group(['middleware' => 'auth:driver_api'],function(){
Route::post('change_password','AuthController@change_password');
Route::post('updatelatlon','AddressController@updatelatlon');
Route::get('current_orders','OrderController@current_orders');
Route::get('last_orders','OrderController@last_orders');
Route::get('new_orders','OrderController@new_orders');
Route::post('change_delivery_status','OrderController@change_delivery_status');
Route::post('order_delivered_status','OrderController@order_delivered_status');

Route::get('change_driver_available','AuthController@change_driver_available');

Route::post('send_problem_on_order','ProblemReasonController@send_problem_on_order');

Route::post('receive_box','BoxController@receive_box');
Route::post('box_delivery','BoxController@box_delivery');

Route::post('attendance_registration','AttendanceDriverController@attendance_registration');
Route::post('check_out','AttendanceDriverController@check_out');

Route::get('driver_home','OrderController@driver_home');

Route::post('add_captain','CaptainController@add_captain');
Route::post('edit_captain','CaptainController@edit_captain');
Route::post('delete_captain','CaptainController@delete_captain');
Route::get('my_captains','CaptainController@my_captains');
Route::post('change_captain_status','CaptainController@change_captain_status');

Route::post('choose_driver_order','OrderCompanyController@choose_driver_order');
Route::post('call_seller_for_order','OrderCompanyController@call_seller_for_order');
Route::post('order_available_captains','OrderCompanyController@order_available_captains');


});
});
Route::get('checklat','api\CouponController@checklat');
