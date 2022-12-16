<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'], function () {

    Route::post('login', 'AuthController@login'); // == Login ==

    // Get Public Data
    Route::get('space/type', 'GetController@get_space_type'); // == get space type==
    Route::get('states', 'GetController@get_state'); // == get all State ==
    Route::get('state/{id}/cities', 'GetController@get_cities'); // == get all cities by state id ==
    Route::post('parcels', 'GetController@get_parcels'); // == get all parcels ==



    // For Authentication
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', 'AuthController@get_profile');
        Route::post('profile', 'AuthController@edit_profile');

        Route::get('parcel/index', 'ParcelController@index_parcels'); // == all  his Parcel  ==
        Route::post('parcel/create', 'ParcelController@create_parcels'); // == create Parcel ==
        Route::post('parcel/{id}/edit', 'ParcelController@edit_parcels'); // == edit Parcel ==
        Route::get('parcel/{id}/show', 'ParcelController@show_parcels'); // == show Parcel ==
        Route::delete('parcel/{id}/delete', 'ParcelController@delete_parcels'); // == dElete  Parcel ==

    });



    // Route::group(
    //     [
    //         'prefix' => LaravelLocalization::setLocale(),
    //         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    //     ],
    //     function () {
    //         // == This routes user must be logged in ==
    //         Route::group(['middleware' => ['auth:api']], function () {
    //         });
    //     }
    // );
});
