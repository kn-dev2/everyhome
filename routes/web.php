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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('book-now', 'HomeController@book_now')->name('book.now');
Route::get('booknow-login', 'HomeController@booknow_login')->name('booknow.login');

Route::get('gift-cards', 'HomeController@gift_card')->name('gift.card');
Route::get('services', 'HomeController@services')->name('services');
Route::get('hiring', 'HomeController@hiring')->name('hiring');

// Route::post('/login', [
//     'uses'          => 'Auth\LoginController@showLoginForm',
//     'middleware'    => 'checkstatus',
// ]);

Route::namespace("Admin")->prefix('admin')->group(function(){
	Route::namespace('Auth')->group(function(){
		Route::get('/', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin');
		Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.login');
		Route::post('/login', '\App\Http\Controllers\Auth\LoginController@login');
		Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('admin.logout');
	});
	Route::post('logout', '\App\Http\Controllers\Admin\DashboardController@logout')->name('logout');

	Route::group(['middleware' => ['admin']], function () {
		Route::get('/profile', '\App\Http\Controllers\Admin\ProfileController@edit')->name('profile');
		Route::post('/profile/update', '\App\Http\Controllers\Admin\ProfileController@update')->name('profile.update');

		Route::get('/dashboard', '\App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');

		Route::resource('customers', '\App\Http\Controllers\Admin\CustomerController');
		Route::get('customers/{id}', '\App\Http\Controllers\Admin\CustomerController@search')->name('customers.search');

		Route::resource('maids', '\App\Http\Controllers\Admin\MaidController');

		Route::resource('services', '\App\Http\Controllers\Admin\ServiceController');

		Route::resource('hometypes', '\App\Http\Controllers\Admin\HomeTypesController');

		Route::resource('homesubtypes', '\App\Http\Controllers\Admin\HomeSubTypesController');

		Route::resource('extra_services', '\App\Http\Controllers\Admin\ExtraServicesController');

		Route::resource('discount_codes', '\App\Http\Controllers\Admin\DiscountCodesController');

		Route::resource('bookings', '\App\Http\Controllers\Admin\BookingsController');

		Route::resource('timeslots', '\App\Http\Controllers\Admin\TimeSlotsController');

		Route::get('/setting', '\App\Http\Controllers\Admin\SettingController@index')->name('setting');
		Route::post('/setting/update', '\App\Http\Controllers\Admin\SettingController@update')->name('setting.update');
	});

	Route::get('ajax.timeslots', '\App\Http\Controllers\Admin\TimeSlotsController@ajaxGetSlots')->name('ajax.time.slots');
	Route::get('ajax.getServicedata', '\App\Http\Controllers\Admin\HomeTypesController@ajaxGetServiceData')->name('ajax.service.data');
	Route::get('ajax.getHomeTypedata', '\App\Http\Controllers\Admin\HomeTypesController@ajaxGetHomeTypeData')->name('ajax.home_type.data');
	Route::get('ajax.getHomeSubTypedata', '\App\Http\Controllers\Admin\HomeSubTypesController@ajaxGetHomeSubTypeData')->name('ajax.home_sub_type.data');
	Route::post('ajax-check-discount', '\App\Http\Controllers\HomeController@ajaxCheckDiscountCode')->name('ajax.check.discount.code');
	Route::post('ajax-book-order-validate', '\App\Http\Controllers\HomeController@ajaxBookOrderValidate')->name('ajax.book.order.validate');
	Route::post('ajax-book-order-now', '\App\Http\Controllers\HomeController@ajaxBookOrder')->name('ajax.book.order.now');
	Route::post('ajax-booking-request', '\App\Http\Controllers\Maid\ScheduleController@AjaxBookingRequest')->name('ajax.booking.request');

	Route::get('payment/{transaction_id}', '\App\Http\Controllers\HomeController@payment')->name('payment');
	Route::post('ajax-booking-review', '\App\Http\Controllers\HomeController@AjaxBookingReview')->name('ajax.booking.review');
	Route::post('ajax-edit-booking-schedule', '\App\Http\Controllers\HomeController@AjaxEditBookingSchedule')->name('ajax.edit.booking.schedule');
});


Route::group(['middleware' => ['auth']], function () {

	Route::get('profile', '\App\Http\Controllers\Customer\ProfileController@index')->name('customer.profile');

	Route::post('update/profile', '\App\Http\Controllers\Customer\ProfileController@update')->name('customer.profile.update');

	Route::get('/password', '\App\Http\Controllers\Customer\ProfileController@password')->name('customer.password');

	Route::post('/password/update', '\App\Http\Controllers\Customer\ProfileController@updatePassword')->name('customer.password.update');

	Route::get('/orders', '\App\Http\Controllers\Customer\ProfileController@allOrders')->name('customer.orders');

	Route::get('/order/{order_id}', '\App\Http\Controllers\Customer\ProfileController@singleOrder')->name('customer.order.details');

});

Route::group(['middleware' => ['maid']], function () {
	Route::get('/maid/dashboard', '\App\Http\Controllers\Maid\DashboardController@index')->name('maid.dashboard');
	Route::get('/maid/schedule', '\App\Http\Controllers\Maid\ScheduleController@confirmRequest')->name('maid.confirm.request');
	Route::resource('schedules', '\App\Http\Controllers\Maid\ScheduleController');
});

