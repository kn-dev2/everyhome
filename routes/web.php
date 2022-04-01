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
Route::get('gift-cards', 'HomeController@gift_card')->name('gift.card');
Route::get('services', 'HomeController@services')->name('services');
Route::get('hiring', 'HomeController@hiring')->name('hiring');

Route::namespace("Admin")->prefix('admin')->group(function(){
	Route::namespace('Auth')->group(function(){
		Route::get('/login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('admin.login');
		Route::post('/login', '\App\Http\Controllers\Auth\LoginController@login');
		Route::post('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('admin.logout');
	});
	Route::post('logout', '\App\Http\Controllers\Admin\DashboardController@logout')->name('logout');

	Route::group(['middleware' => ['auth']], function () {
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
	});
});
