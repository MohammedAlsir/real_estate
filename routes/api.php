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

    Route::get('parcels/catigories', 'GetController@get_parcels_category'); // == get space type==
    Route::get('parcels/type', 'GetController@get_parcels_type'); // == get space type==


    Route::post('parcels', 'GetController@get_parcels'); // == get all parcels ==
    Route::get('parcels/{id}', 'GetController@get_parcels_by_id'); // == get parcel by id ==
    Route::post('houses', 'GetController@get_houses'); // == get all houses ==
    Route::get('houses/{id}', 'GetController@get_houses_by_id'); // == get parcel by id ==

    Route::post('apartments', 'GetController@get_apartments'); // == get all apartments ==
    Route::get('apartments/{id}', 'GetController@get_apartments_by_id'); // == get parcel by id ==

    Route::get('ads', 'GetController@get_all_ads'); // == get ads==





    // For Authentication
    Route::group(['middleware' => ['auth:api', 'status']], function () {
        Route::get('profile', 'AuthController@get_profile');
        Route::post('profile', 'AuthController@edit_profile');

        // For Parcel
        Route::get('parcel/index', 'ParcelController@index_parcels'); // == all  his Parcel  ==
        Route::post('parcel/create', 'ParcelController@create_parcels'); // == create Parcel ==
        Route::post('parcel/{id}/edit', 'ParcelController@edit_parcels'); // == edit Parcel ==
        Route::get('parcel/{id}/show', 'ParcelController@show_parcels'); // == show Parcel ==
        Route::delete('parcel/{id}/delete', 'ParcelController@delete_parcels'); // == delete  Parcel ==

        // For house
        Route::get('house/index', 'HouseController@index_house'); // == all  his house  ==
        Route::post('house/create', 'HouseController@create_house'); // == create house ==
        Route::post('house/{id}/edit', 'HouseController@edit_house'); // == edit house ==
        Route::get('house/{id}/show', 'HouseController@show_house'); // == show house ==
        Route::delete('house/{id}/delete', 'HouseController@delete_house'); // == delete  house ==

        // For apartment
        Route::get('apartment/index', 'ApartmentController@index_apartment'); // == all  his apartment  ==
        Route::post('apartment/create', 'ApartmentController@create_apartment'); // == create apartment ==
        Route::post('apartment/{id}/edit', 'ApartmentController@edit_apartment'); // == edit apartment ==
        Route::get('apartment/{id}/show', 'ApartmentController@show_apartment'); // == show apartment ==
        Route::delete('apartment/{id}/delete', 'ApartmentController@delete_apartment'); // == delete  house ==

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
