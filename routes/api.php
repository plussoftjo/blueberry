<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * 
 *  Main Controller
 * Api\App
 */


Route::get('main/index','App\Http\Controllers\Api\App\MainController@index');


// Get Items From Category Id
Route::get('items/withCategoriesId/{id}','App\Http\Controllers\Api\App\MainController@getItemsWithCategoryId');



// ---------- User Method --------------- //
// Address
Route::post('user/add_address','App\Http\Controllers\Api\App\AddressController@store');

// ---------- User Auth --------------- //
Route::post('user/login','App\Http\Controllers\Api\App\AuthController@login');
Route::post('user/register','App\Http\Controllers\Api\App\AuthController@register');
Route::group(['middleware' => 'auth:api'], function () {
    /**
    * Auth [UserAuth][GET]
    * withData => [token]
    * response => [userInfo]
    */
    Route::get('user/auth', 'App\Http\Controllers\Api\App\AuthController@auth');
});

    Route::get('user/check', 'App\Http\Controllers\Api\App\AuthController@checkUser');


// ---------- Orders --------------- //
Route::post('order/store','App\Http\Controllers\Api\App\OrdersController@store');
Route::get('order/show/{id}','App\Http\Controllers\Api\App\OrdersController@showOrder');
Route::post('order/changeState','App\Http\Controllers\Api\App\OrdersController@changeOrderState');

// ----------- Search --------------//
Route::post('search','App\Http\Controllers\Api\App\MainController@search');

// ---- Check Discount //
Route::post('discount/check','App\Http\Controllers\Api\App\MainController@checkCode');


// ---- Notification Token --//
Route::post('notification_token/store','App\Http\Controllers\Api\App\MainController@SaveNotificationToken');

// ------- Controller App  //
Route::group(['prefix' => 'controller'], function () {
    Route::post('auth/login','App\Http\Controllers\Api\Controller\AuthController@login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('auth/auth','App\Http\Controllers\Api\Controller\AuthController@auth');
    });


    // Order Controller
    Route::get('order/index/{id}','App\Http\Controllers\Api\Controller\OrderControllers@index');
    Route::post('order/changeUser','App\Http\Controllers\Api\Controller\OrderControllers@changeUser');
    Route::post('order/changeStatus','App\Http\Controllers\Api\Controller\OrderControllers@changeState');
    Route::get('main/index','App\Http\Controllers\Api\Controller\OrderControllers@MainIndex');

    Route::get('main/paignation','App\Http\Controllers\Api\Controller\OrderControllers@getWithPaig');
    Route::get('main/getToken','App\Http\Controllers\Api\Controller\OrderControllers@getToken');
});