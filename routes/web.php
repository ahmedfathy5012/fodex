<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('adminlogin', 'LoginController@adminlogin')->name('adminlogin');
Route::post('login', 'LoginController@login')->name('login');
Route::group(['middleware' => 'auth:employee'], function () {
  Route::get('/', 'DashboardController@index')->name('dashboard');
  Route::post('filter_dashboard', 'DashboardController@filter_dashboard')->name('filter_dashboard');
  Route::get('statistic', 'StatisticController@statistic')->name('statistic');
  Route::get('countrystatistic', 'StatisticController@countrystatistic')->name('countrystatistic');
  Route::get('employeestatistic', 'StatisticController@employeestatistic')->name('employeestatistic');
  Route::post('filtercharts', 'StatisticController@filtercharts')->name('filtercharts');
  Route::get('adminlogout', 'LoginController@adminlogout')->name('adminlogout');
  Route::resource('orderstatus', 'OrderStatusController', ['except' => ['store']]);
  Route::post("orderstatus/store", "OrderStatusController@store")->name("orderstatus.store");
  Route::resource('boxstatus', 'BoxStatusController', ['except' => ['store']]);
  Route::post("boxstatus/store", "BoxStatusController@store")->name("boxstatus.store");
  //charts
  Route::get('mostresitems', 'DashboardController@mostresitems')->name('mostresitems');
  Route::get('mostsellerorder', 'DashboardController@mostsellerorder')->name('mostsellerorder');
  Route::get('mostdriverorder', 'DashboardController@mostdriverorder')->name('mostdriverorder');
  Route::get('mostitemorder', 'DashboardController@mostitemorder')->name('mostitemorder');
  //country chart
  Route::get('mostcountryorder', 'DashboardController@mostcountryorder')->name('mostcountryorder');
  Route::get('mostcountryprice', 'DashboardController@mostcountryprice')->name('mostcountryprice');
  Route::get('moststateorder', 'DashboardController@moststateorder')->name('moststateorder');
  Route::get('moststateprice', 'DashboardController@moststateprice')->name('moststateprice');
  Route::get('mostcityorder', 'DashboardController@mostcityorder')->name('mostcityorder');
  Route::get('mostcityprice', 'DashboardController@mostcityprice')->name('mostcityprice');
  Route::get('mostzoneorder', 'DashboardController@mostzoneorder')->name('mostzoneorder');
  Route::get('mostzoneprice', 'DashboardController@mostzoneprice')->name('mostzoneprice');
  Route::get('fastemployeeorder', 'DashboardController@fastemployeeorder')->name('fastemployeeorder');
  //boxs
  Route::resource('boxs', 'BoxController');
  Route::resource('boxtake', 'BoxTakeController');
  Route::resource('boxdeliver', 'BoxDeliverController');
  //wallet
  Route::get('wallet', 'WalletController@wallet')->name('wallet');
  Route::post('walletfilter', 'WalletController@walletfilter')->name('walletfilter');
  //ajax 
  Route::get('getstates/{id}', 'AjaxController@getstates')->name('getstates');
  Route::get('getcities/{id}', 'AjaxController@getcities')->name('getcities');
  Route::get('getzones/{id}', 'AjaxController@getzones')->name('getzones');
  //ajax zones
  Route::post('filterstates', 'AjaxController@filterstates')->name('filterstates');
  Route::post('filtercities', 'AjaxController@filtercities')->name('filtercities');
  Route::post('filterzones', 'AjaxController@filterzones')->name('filterzones');
  //ajax expense types
  Route::get('filterexpensetype/{id}', 'AjaxController@filterexpensetype')->name('filterexpensetype');
  //ajax collection types
  Route::get('filtercollectiontype/{id}', 'AjaxController@filtercollectiontype')->name('filtercollectiontype');
  Route::get('getstatesemployee/{id}', 'AjaxController@getstatesemployee')->name('getstatesemployee');
  Route::get('getcitiesemployee/{id}', 'AjaxController@getcitiesemployee')->name('getcitiesemployee');
  Route::get('getzonesemployee/{id}', 'AjaxController@getzonesemployee')->name('getzonesemployee');
  Route::post('getstatesmultiple', 'AjaxController@getstatesmultiple')->name('getstatesmultiple');
  Route::post('getcitiesmultiple', 'AjaxController@getcitiesmultiple')->name('getcitiesmultiple');
  Route::post('getzonesmultiple', 'AjaxController@getzonesmultiple')->name('getzonesmultiple');
  Route::get('getdays', 'AjaxController@getdays')->name('getdays');
  Route::get('filter_subcategories/{id}', 'AjaxController@filter_subcategories')->name('filter_subcategories');
  Route::get('getsubcategories/{id}', 'AjaxController@getsubcategories')->name('getsubcategories');
  Route::get('getsellerscategory/{id}', 'AjaxController@getsellerscategory')->name('getsellerscategory');
  Route::get('notification', 'NotificationController@notification')->name('notification');
  Route::post('storenotification', 'NotificationController@storenotification')->name('storenotification');
  Route::get('notificationdriver', 'NotificationController@notificationdriver')->name('notificationdriver');
  Route::post('storenotificationdriver', 'NotificationController@storenotificationdriver')->name('storenotificationdriver');
  Route::get('senddriversnoti', 'NotificationController@senddriversnoti')->name('senddriversnoti');
  Route::post('storedriversnoti', 'NotificationController@storedriversnoti')->name('storedriversnoti');
  Route::get('sendusersnoti', 'NotificationController@sendusersnoti')->name('sendusersnoti');
  Route::post('storeusersnoti', 'NotificationController@storeusersnoti')->name('storeusersnoti');

  Route::get('sendcompanysnoti', 'NotificationController@sendcompanysnoti')->name('sendcompanysnoti');
  Route::post('storecompanysnoti', 'NotificationController@storecompanysnoti')->name('storecompanysnoti');

  // Route::resource('user', 'UserController');
  Route::resource('address', 'AddressController');

  Route::resource('country', 'CountryController');
  Route::resource('state', 'StateController');
  Route::resource('city', 'CityController');
  Route::resource('major', 'MajorController');
  Route::post('major_order', 'MajorController@major_order')->name('major_order');
  //major offers
  Route::get('majorsoffers/{id}', 'MajorOfferController@index')->name('majoroffers.index');
  Route::get('createmajorsoffers/{id}', 'MajorOfferController@create')->name('majoroffers.create');
  Route::post('storemajorsoffers/{id}', 'MajorOfferController@store')->name('majoroffers.store');
  Route::get('editmajorsoffers/{id}', 'MajorOfferController@edit')->name('majoroffers.edit');
  Route::put('updatemajorsoffers/{id}', 'MajorOfferController@update')->name('majoroffers.update');
  Route::delete('deletemajorsoffers/{id}', 'MajorOfferController@destroy')->name('majoroffers.destroy');
  Route::resource('usertype', 'UsertypeController');
  Route::resource('category', 'CategoryController');
  Route::resource('coupons', 'CouponController');
  Route::get('sellercategory/{id}', 'CategoryController@sellercategory')->name('sellercategory');
  Route::post('add_category_seller', 'CategoryController@add_category_seller')->name('add_category_seller');
  Route::get('addfav1/{id}', 'CategoryController@addfav1')->name('addfav1');
  Route::resource('subcategory', 'SubcategoryController');
  Route::resource('item', 'ItemController');
  Route::get('itemseller/{id}', 'ItemController@itemseller')->name('itemseller');
  Route::post('hideitem', 'ItemController@hideitem')->name('hideitem');
  Route::get('availableitem/{id}', 'ItemController@availableitem')->name('availableitem');
  Route::get('addfav/{id}', 'ItemController@addfav')->name('addfav');
  Route::resource('image', 'ImageController');
  Route::resource('sellercategory', 'SellercategoryController');
  Route::resource('orders', 'OrderController');
  Route::get('dailyorders', 'OrderController@dailyorders')->name("dailyorders");
  Route::post('changeorderstatus_id', 'OrderController@changeorderstatus_id')->name("changeorderstatus_id");
  Route::get('checkres/{id}', 'OrderController@checkres')->name("checkres");
  Route::get('sellerorders/{id}', 'OrderController@sellerorders')->name('sellerorders');
  Route::get('driverorders/{id}', 'OrderController@driverorders')->name('driverorders');
  Route::get('driver_cuurent_orders/{id}', 'OrderController@driver_cuurent_orders')->name('driver_cuurent_orders');
  Route::post('delivery_fee', 'OrderController@delivery_fee')->name('delivery_fee');
  //itemorder
  Route::delete('deleteitemorder/{id}', 'OrderController@deleteitemorder')->name('deleteitemorder');
  Route::post('changequantity', 'OrderController@changequantity')->name('changequantity');
  Route::resource('incomes', 'IncomeController');
  //roles
  Route::resource('roles', 'RoleController');
  Route::post('editprice', 'OrderController@editprice');
  Route::post('orderstatus', 'OrderController@orderstatus')->name('orderstatus');

  Route::post('choosedriver', 'OrderController@choosedriver')->name('choosedriver');
  Route::post('choosecompany', 'OrderController@choosecompany')->name('choosecompany');

  Route::get('showorders/{id}', 'OrderController@showorders')->name('showorders');
  Route::resource('seller', 'SellerController');
  Route::get('seller/add_central', 'SellerController@create')->name('seller.add_central');
  Route::get('orderitemseller/{id}', 'SellerController@orderitemseller')->name('orderitemseller');
  Route::get('sellercontracts/{id}', 'SellerController@sellercontracts')->name('sellercontracts');
  Route::get('addsellercontract/{id}', 'SellerController@addsellercontract')->name('addsellercontract');
  Route::post('storesellercontract/{id}', 'SellerController@storesellercontract')->name('storesellercontract');
  Route::get('editsellercontract/{id}', 'SellerController@editsellercontract')->name('editsellercontract');
  Route::post('updatesellercontract/{id}', 'SellerController@updatesellercontract')->name('updatesellercontract');
  Route::delete('deletesellercontract/{id}', 'SellerController@deletesellercontract')->name('deletesellercontract');
  Route::get('activesellercontract/{id}', 'SellerController@activesellercontract')->name('activesellercontract');
  //employee contracts 
  Route::get('employeecontracts/{id}', 'EmployeeController@employeecontracts')->name('employeecontracts');
  Route::get('addemployeecontract/{id}', 'EmployeeController@addemployeecontract')->name('addemployeecontract');
  Route::post('storeemployeecontract/{id}', 'EmployeeController@storeemployeecontract')->name('storeemployeecontract');
  Route::get('editemployeecontract/{id}', 'EmployeeController@editemployeecontract')->name('editemployeecontract');
  Route::post('updateemployeecontract/{id}', 'EmployeeController@updateemployeecontract')->name('updateemployeecontract');
  Route::delete('deleteemployeecontract/{id}', 'EmployeeController@deleteemployeecontract')->name('deleteemployeecontract');
  Route::get('activeemployeecontract/{id}', 'EmployeeController@activeemployeecontract')->name('activeemployeecontract');
  //driver contracts 
  Route::get('drivercontracts/{id}', 'DriverController@drivercontracts')->name('drivercontracts');
  Route::get('adddrivercontract/{id}', 'DriverController@adddrivercontract')->name('adddrivercontract');
  Route::post('storedrivercontract/{id}', 'DriverController@storedrivercontract')->name('storedrivercontract');
  Route::get('editdrivercontract/{id}', 'DriverController@editdrivercontract')->name('editdrivercontract');
  Route::post('updatedrivercontract/{id}', 'DriverController@updatedrivercontract')->name('updatedrivercontract');
  Route::delete('deletedrivercontract/{id}', 'DriverController@deletedrivercontract')->name('deletedrivercontract');
  Route::get('activedrivercontract/{id}', 'DriverController@activedrivercontract')->name('activedrivercontract');
  Route::resource('sellerimage', 'SellerimageController');
  Route::resource('sellermessage', 'SellermessageController');
  Route::resource('extra', 'ExtraController');
  Route::resource('size', 'SizeController');
  Route::resource('offers', 'OfferController');
  Route::resource('expensetype', 'ExpenseTypeController');
  Route::resource('collectionstypes', 'AllcollectionTypeController');
  Route::resource('expenses', 'ExpenseController');
  Route::post('addcollection', 'SellerController@addcollection');
  Route::resource('expensedriver', 'ExpenseDriverController');
  Route::post('getdriversallary/{id}', 'ExpenseDriverController@getdriversallary');
  Route::get('allcollections', 'ExpenseDriverController@allcollections')->name("allcollections");
  Route::resource('expenseemployee', 'ExpenseEmployeeController');
  Route::resource('workschedule', 'WorkscheduleController');
  Route::get('createsellerworkschedule/{id}', 'SellerWorkscheduleController@create')->name('sellerworkschedule.create');
  Route::PUT('updatesellerworkschedule/{id}', 'SellerWorkscheduleController@update')->name('sellerworkschedule.update');
  Route::get('editsellerworkschedule/{id}', 'SellerWorkscheduleController@edit')->name('sellerworkschedule.edit');
  Route::post('storesellerworkschedule/{id}', 'SellerWorkscheduleController@store')->name('sellerworkschedule.store');
  Route::get('indexsellerworkschedule/{id}', 'SellerWorkscheduleController@index')->name('sellerworkschedule.index');
  Route::delete('destorysellerworkschedule/{id}', 'SellerWorkscheduleController@destory')->name('sellerworkschedule.destory');
  //awards 
  Route::post('awardemployee', 'EmployeeController@awardemployee');
  Route::get('employeeawards/{id}', 'EmployeeController@employeeawards')->name('employeeawards');
  //discounts
  Route::post('discountemployee', 'EmployeeController@discountemployee');
  Route::get('employeediscounts/{id}', 'EmployeeController@employeediscounts')->name('employeediscounts');
  //notcollect employees 
  Route::get('notcollectemployees', 'EmployeeController@notcollectemployees')->name('notcollectemployees');
  //notcollect driver 
  Route::get('notcollectdriver', 'DriverController@notcollectdriver')->name('notcollectdriver');
  //notcollect sellers 
  Route::get('notcollectsellers', 'SellerController@notcollectsellers')->name('notcollectsellers');
  //addcollection
  Route::get('addcollection', 'SellerController@addcollection')->name('addcollection');
  Route::post('order_numbercategory', 'CategoryController@order_numbercategory')->name('order_numbercategory');
  //expense employee
  Route::post('addemplyeeexpense', 'EmployeeController@addemplyeeexpense')->name('addemplyeeexpense');
  //driver expense
  Route::post('adddriverexpense', 'DriverController@adddriverexpense')->name('adddriverexpense');
  Route::resource('day', 'DayController');
  Route::resource('social', 'SocialController');
  Route::resource('extradetail', 'ExtradetailController');
  Route::resource('employee', 'EmployeeController');
  Route::get('getemployeesalary/{id}', 'EmployeeController@getemployeesalary');
  Route::resource('employeescontract', 'EmployeescontractController');
  Route::post('blockemployee', 'EmployeeController@blockemployee')->name('blockemployee');
  Route::resource('attendance', 'AttendanceController');
  Route::resource('sellercontract', 'SellercontractController');
  Route::post('blockseller', 'SellerController@blockseller')->name('blockseller');
  Route::get('openseller/{id}', 'SellerController@openseller')->name('openseller');
  Route::get('choose_seller_website/{id}', 'SellerController@choose_seller_website')->name('choose_seller_website');
  Route::resource('jobtitle', 'JobtitleController');
  Route::resource('gender', 'GenderController');
  Route::resource('packagescategories', 'PackageCategoryController');
  Route::resource('refusedreasons', 'RefusedReasonController');
  Route::resource('coins', 'CoinController');
  Route::resource('tags', 'TagController');
  Route::resource('payments', 'PaymentController');
  Route::get('getpackage/{id1}/{id2}', 'SubscriptionController@getpackage');
  Route::get('subscriptions/{id}', 'SubscriptionController@index')->name('subscriptions');
  Route::get('createsubscription/{id}', 'SubscriptionController@create')->name('createsubscription');
  Route::post('storesubscription/{id}', 'SubscriptionController@store')->name('storesubscription');
  Route::get('editsubscription/{id}', 'SubscriptionController@edit')->name('editsubscription');
  Route::post('updatesubscription/{id}', 'SubscriptionController@update')->name('updatesubscription');
  Route::delete('deletesubscription/{id}', 'SubscriptionController@destroy')->name('deletesubscription');
  Route::resource('packages', 'PackageController');
  Route::resource('homecontent', 'HomeContentController');
  Route::get('sellerscontent/{id}', 'HomeContentController@sellerscontent')->name('sellerscontent');
  Route::post('changesellerstatus', 'HomeContentController@changesellerstatus')->name('changesellerstatus');
  Route::post('order_numberseller', 'HomeContentController@order_numberseller')->name('order_numberseller');
  Route::get('deletesellerhome/{id}', 'HomeContentController@deletesellerhome')->name('deletesellerhome');
  Route::get('addseller/{id}', 'HomeContentController@addseller')->name('addseller');
  Route::post('updatehomeseller/{id}', 'HomeContentController@updatehomeseller')->name('updatehomeseller');
  //majorclassification
  Route::resource('majorclassification', 'MajorClassificationController');
  Route::get('createmajorclassificationselect/{id}', 'MajorClassificationSelectController@create')->name("majorclassificationselect.create");
  Route::post('storemajorclassificationselect/{id}', 'MajorClassificationSelectController@store')->name("majorclassificationselect.store");
  Route::get('editmajorclassificationselect/{id}', 'MajorClassificationSelectController@edit')->name("majorclassificationselect.edit");
  Route::put('updatemajorclassificationselect/{id}', 'MajorClassificationSelectController@update')->name("majorclassificationselect.update");
  Route::get('majorclassificationselect/{id}', 'MajorClassificationSelectController@index')->name("majorclassificationselect.index");
  Route::delete('deletemajorclassificationselect/{id}', 'MajorClassificationSelectController@destroy')->name("majorclassificationselect.destroy");
  Route::get('sellersclass/{id}', 'MajorClassificationController@sellersclass')->name('sellersclass');
  // Route::post('changesellerstatus', 'MajorClassificationController@changesellerstatus')->name('changesellerstatus');
  Route::post('order_numbersellerclass', 'MajorClassificationController@order_numbersellerclass')->name('order_numbersellerclass');
  Route::post('order_numbersellerclass1', 'MajorClassificationController@order_numbersellerclass1')->name('order_numbersellerclass1');
  Route::get('deletesellerclass/{id}', 'MajorClassificationController@deletesellerclass')->name('deletesellerclass');
  Route::get('addsellerclass/{id}', 'MajorClassificationController@addsellerclass')->name('addsellerclass');
  Route::post('updateclassseller/{id}', 'MajorClassificationController@updateclassseller')->name('updateclassseller');
  //
  //majoroffer
  Route::get('createmajoroffer/{id}', 'MajorsclassificationOfferController@create')->name('createmajoroffer');
  Route::post('storemajoroffer/{id}', 'MajorsclassificationOfferController@store')->name('storemajoroffer');
  Route::get('editmajoroffer/{id}', 'MajorsclassificationOfferController@edit')->name('editmajoroffer');
  Route::post('updatemajoroffer/{id}', 'MajorsclassificationOfferController@update')->name('updatemajoroffer');
  Route::get('majoroffers/{id}', 'MajorsclassificationOfferController@index')->name('majoroffers');
  Route::get('deletemajoroffer/{id}', 'MajorsclassificationOfferController@destroy')->name('deletemajoroffer');
  //majorclassification coontent
  Route::get('createmajorcontent/{id}', 'MajorclassificationContentController@create')->name('createmajorcontent');
  Route::post('storemajorcontent/{id}', 'MajorclassificationContentController@store')->name('storemajorcontent');
  Route::get('editmajorcontent/{id}', 'MajorclassificationContentController@edit')->name('editmajorcontent');
  Route::post('updatemajorcontent/{id}', 'MajorclassificationContentController@update')->name('updatemajorcontent');
  Route::get('majorcontents/{id}', 'MajorclassificationContentController@index')->name('majorcontents');
  Route::get('deletemajorcontent/{id}', 'MajorclassificationContentController@destroy')->name('deletemajorcontent');
  Route::get('sellersmajorcontent/{id}', 'MajorclassificationContentController@sellersmajorcontent')->name('sellersmajorcontent');
  //Route::post('changesellerstatus', 'MajorclassificationContentController@changesellerstatus')->name('changesellerstatus');
  Route::post('order_numbersellermajorcontent', 'MajorclassificationContentController@order_numbersellermajorcontent')->name('order_numbersellermajorcontent');
  Route::get('deletesellermajorcontent/{id}', 'MajorclassificationContentController@deletesellermajorcontent')
    ->name('deletesellermajorcontent');
  Route::get('addsellermajorcontent/{id}', 'MajorclassificationContentController@addsellermajorcontent')->name('addsellermajorcontent');
  Route::post('updatemajorcontentseller/{id}', 'MajorclassificationContentController@updatemajorcontentseller')->name('updatemajorcontentseller');
  //selleremployees
  Route::get('selleremployees/{id}', 'SellerEmployeeController@index')->name('selleremployees.index');
  Route::get('createselleremployee/{id}', 'SellerEmployeeController@create')->name('selleremployees.create');
  Route::post('storeselleremployee/{id}', 'SellerEmployeeController@store')->name('selleremployees.store');
  Route::get('editselleremployee/{id}', 'SellerEmployeeController@edit')->name('selleremployees.edit');
  Route::put('updateselleremployee/{id}', 'SellerEmployeeController@update')->name('selleremployees.update');
  Route::delete('deleteselleremployee/{id}', 'SellerEmployeeController@destroy')->name('selleremployees.destroy');
  //employee contracts 
  Route::get('employeecontracts/{id}', 'EmployeeController@employeecontracts')->name('employeecontracts');
  Route::get('addemployeecontract/{id}', 'EmployeeController@addemployeecontract')->name('addemployeecontract');
  Route::post('storeemployeecontract/{id}', 'EmployeeController@storeemployeecontract')->name('storeemployeecontract');
  Route::get('editemployeecontract/{id}', 'EmployeeController@editemployeecontract')->name('editemployeecontract');
  Route::post('updateemployeecontract/{id}', 'EmployeeController@updateemployeecontract')->name('updateemployeecontract');
  Route::delete('deleteemployeecontract/{id}', 'EmployeeController@deleteemployeecontract')->name('deleteemployeecontract');
  //countriespermission employee
  Route::get('countriespermissions/{id}', 'EmployeeController@countriespermissions')->name('countriespermissions');
  Route::post('savecountriespermissions/{id}', 'EmployeeController@savecountriespermissions')->name('savecountriespermissions');
  Route::resource('armycase', 'ArmycaseController');
  Route::resource('statussocials', 'StatussocialsController');
  Route::resource('vehicletypes', 'VehicletypesController');
  Route::resource('zone', 'ZoneController');

  Route::resource('delivery_areas', 'DeliveryAreaController');

  Route::resource('driver_companies', 'DriverCompanyController');
  Route::get('company_collections', 'DriverCompanyController@company_collections')->name('company_collections');
  Route::post('add_company_collection', 'DriverCompanyController@add_company_collection')->name('add_company_collection');
  Route::get('company_orders/{id}', 'CompanyOrderController@index')->name('company_orders');

  Route::get('company_drivers/{id}', 'StoreDriverCompanyController@index')->name('company_drivers.index');
  Route::get('create_company_drivers/{id}', 'StoreDriverCompanyController@create')->name('company_drivers.create');
  Route::post('store_company_drivers/{id}', 'StoreDriverCompanyController@store')->name('company_drivers.store');
  Route::get('edit_company_drivers/{id}', 'StoreDriverCompanyController@edit')->name('company_drivers.edit');
  Route::put('update_company_drivers/{id}', 'StoreDriverCompanyController@update')->name('company_drivers.update');
  Route::delete('delete_company_drivers/{id}', 'StoreDriverCompanyController@destroy')->name('company_drivers.destroy');


  Route::resource('driver', 'DriverController');
  Route::resource('userwallet', 'UserwalletController');
  Route::resource('walletmethod', 'WalletmethodController');
  Route::get('editnumbersetting', 'NumberSettingController@edit')->name("editnumbersetting");
  Route::post('updatenumbersetting', 'NumberSettingController@update')->name("updatenumbersetting");
  Route::get('driversmap', 'DriverController@driversmap')->name("driversmap");
  Route::get('driver_map/{id}', 'DriverController@driver_map')->name("driver_map");

  Route::get('get_driver/{id}', 'DriverController@get_driver')->name("get_driver");

  Route::get('alldrivers', 'DriverController@alldrivers')->name("alldrivers");
  Route::get('move', 'DriverController@move')->name("move");
  // event(new CarMoved(53.6304438,10.0472128));
  // event(new CarMoved(53.6304438,10.0472128));
  //  event(new DriverMoved(53.6315479,10.0470709));


  //seller_extras 
  Route::get('seller_extras/{id}', 'SellerextraController@index')->name('seller_extras.index');
  Route::get('createseller_extras/{id}', 'SellerextraController@create')->name('seller_extras.create');
  Route::post('storeseller_extras/{id}', 'SellerextraController@store')->name('seller_extras.store');
  Route::get('editseller_extras/{id}', 'SellerextraController@edit')->name('seller_extras.edit');
  Route::put('updateseller_extras/{id}', 'SellerextraController@update')->name('seller_extras.update');
  Route::delete('deleteseller_extras/{id}', 'SellerextraController@destroy')->name('seller_extras.destroy');


  //sellerzones
  Route::get('sellerzones/{id}', 'SellerZoneController@index')->name('sellerzones');
  Route::get('createsellerzones/{id}', 'SellerZoneController@create')->name('createsellerzones');
  Route::post('storesellerzones/{id}', 'SellerZoneController@store')->name('storesellerzones');
  Route::get('editstoresellerzones/{id}', 'SellerZoneController@edit')->name('editstoresellerzones');
  Route::put('updatesellerzones/{id}', 'SellerZoneController@update')->name('updatesellerzones');
  Route::delete('deletesellerzones/{id}', 'SellerZoneController@destroy')->name('deletesellerzones');

  //user wallets
  Route::get('createuserwallet', 'UserwalletController@create')->name('createuserwallet');
  Route::post('storeuserwallet', 'UserwalletController@store')->name('storeuserwallet');
  Route::get('userwallets', 'UserwalletController@index')->name('userwallets');

  //report
  Route::get('areas_report', 'ReportController@areas_report')->name("areas_report");

  //country orders
  Route::get('country_orders', 'CountryOrderController@index')->name("country_orders");

  //state orders
  Route::get('state_orders', 'StateOrderController@index')->name("state_orders");

  //city orders
  Route::get('city_orders', 'CityOrderController@index')->name("city_orders");

  //zone orders
  Route::get('zone_orders', 'ZoneOrderController@index')->name("zone_orders");


  //country icomes
  Route::get('country_icomes', 'CountryIncomeController@index')->name("country_icomes");
  Route::post('filtercountry_icomes', 'CountryIncomeController@filtercountry_icomes')->name("filtercountry_icomes");

  //state icomes
  Route::get('state_icomes', 'StateIncomeController@index')->name("state_icomes");
  Route::post('filterstate_icomes', 'StateIncomeController@filterstate_icomes')->name("filterstate_icomes");

  //state icomes
  Route::get('city_icomes', 'CityIncomeController@index')->name("city_icomes");
  Route::post('filtercity_icomes', 'CityIncomeController@filtercity_icomes')->name("filtercity_icomes");

  //zone icomes
  Route::get('zone_icomes', 'ZoneIncomeController@index')->name("zone_icomes");
  Route::post('filterzone_icomes', 'ZoneIncomeController@filterzone_icomes')->name("filterzone_icomes");

  //major icomes
  Route::get('major_icomes', 'MajorIncomeController@index')->name("major_icomes");
  Route::post('filtermajor_incomes', 'MajorIncomeController@filtermajor_incomes')->name("filtermajor_incomes");


  //app_status
  // 
  Route::get('app_status', 'AppStatusController@edit')->name("app_status.edit");
  Route::put('app_status/edit', 'AppStatusController@update')->name("app_status.update");

  //seller_money
  Route::get('seller_money', 'SellerMoneyController@index')->name("seller_money");

  //driver_money
  Route::get('driver_money', 'DriverMoneyController@index')->name("driver_money");

  //problem_reasons
  Route::resource('problem_reasons', 'ProblemReasonController');

  Route::post('change_delivery_status', 'OrderController@change_delivery_status')->name("change_delivery_status");

  //seller_items
  Route::get('seller_items/{id}', 'SellerItem2Controller@index')->name('seller_items');
  Route::get('create_seller_items/{id}', 'SellerItem2Controller@create')->name('create_seller_items');
  Route::post('store_seller_items/{id}', 'SellerItem2Controller@store')->name('store_seller_items');
  Route::get('edit_seller_items/{id}', 'SellerItem2Controller@edit')->name('edit_seller_items');
  Route::put('update_seller_items/{id}', 'SellerItem2Controller@update')->name('update_seller_items');
  Route::delete('delete_seller_items/{id}', 'SellerItem2Controller@destroy')->name('delete_seller_items');

  //users
  Route::get('users', 'UserController@index')->name('users');
  Route::get('user_orders/{id}', 'UserController@user_orders')->name('user_orders');
  Route::get('block_user/{id}', 'UserController@block_user')->name('block_user');
  Route::get('user_profile/{id}', 'UserController@user_profile')->name('user_profile');

  //city && zone && state
  //user wallets
  Route::get('country_states/{id}', 'CountryController@country_states')->name('country_states');
  Route::get('state_cities/{id}', 'StateController@state_cities')->name('state_cities');
  Route::get('city_zones/{id}', 'CityController@city_zones')->name('city_zones');
});
//seller dashboard
Route::group(['prefix' => 'sellerdash'], function () {
  // Route::group(['middleware' => 'guest:seller'],function(){
  Route::get('sellerlogin', 'LoginController@sellerlogin')->name('sellerlogin');
  Route::post('sellerlogindash', 'LoginController@sellerlogindash')->name('sellerlogindash');
  //});
  Route::group(['middleware' => 'auth:selleremployee'], function () {
    Route::get('myorders', 'SellerOrderController@myorders')->name('myorders');
    Route::get('showmyorders/{id}', 'SellerOrderController@showmyorders')->name('showmyorders');
    Route::resource('myitems', 'SellerItemController');
    Route::get('mydashboard', 'SellerDashboardController@index')->name('mydashboard');
    //charts
    Route::get('mostmyitemsorder', 'SellerDashboardController@mostmyitemsorder')->name('mostmyitemsorder');
    Route::resource('myworkschedule', 'Seller2WorkscheduleController');
    Route::resource('myselleremployees', 'SellerEmployee2Controller');

    Route::get('sellerlogout', 'LoginController@sellerlogout')->name("sellerlogout");
  });
});
