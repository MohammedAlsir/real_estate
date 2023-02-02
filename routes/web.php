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

Route::get('/', function () {
    return redirect()->route('home');
});
// privacy policy
Route::get('privacy_policy', function () {
    return view('privacy_policy');
});


Auth::routes();

Route::namespace('App\Http\Controllers')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('profile', 'SettingController@profile')->name('profile');
    Route::put('profile', 'SettingController@profile_edit')->name('profile_edit');

    Route::get('settings', 'SettingController@settings')->name('settings');
    Route::put('settings', 'SettingController@settings_edit')->name('settings_edit');

    // Delete image by ID
    // Route::delete('delete/image/{id}', 'HotelController@delete_image')->name('delete.image');
    Route::resource('state/city', 'StateCityController');

    Route::resource('agent', 'AgentController');

    Route::get('payment/{id}', 'AgentController@payment')->name('payment');

    Route::resource('parcel', 'ParcelController');

    // Route::get('index/parcel/{id?}', 'ParcelController@index')->name('parcel.index');
    Route::resource('houses', 'HouseController');

    Route::resource('apartments', 'ApartmentController');

    Route::resource('hotels', 'HotelController');

    Route::resource('ads', 'AdsController');
});
