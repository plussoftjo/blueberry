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
    return view('welcome');
});

Route::get('/main',function() {
    return view('Main');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Orders
    Route::get('order','App\Http\Controllers\Admin\OrderController@index');
    // Orders Index
    Route::get('orders/index','App\Http\Controllers\Admin\OrderController@GetIndex');
    Route::get('order/show/{id}','App\Http\Controllers\Admin\OrderController@ShowOrder');
    Route::post('order/update_status','App\Http\Controllers\Admin\OrderController@UpdateStatus');

    // Goods Basket
    Route::get('goodsbasket/get','App\Http\Controllers\Admin\OrderController@BasketOfGoodsGet');
    Route::post('goodsbasket/set','App\Http\Controllers\Admin\OrderController@ChangeGoodsBasketValue');


    // Deliver Fee
    Route::get('deliverfee/get','App\Http\Controllers\Admin\OrderController@GetDeliveryFee');
    Route::post('deliverfee/set','App\Http\Controllers\Admin\OrderController@SetDeliverFee');

    // Notification Send 
    Route::post('send_notification','App\Http\Controllers\Admin\NotificationHandler@SendNotifiaction');
Route::get('notification_token/get','App\Http\Controllers\Admin\NotificationHandler@getToken');


});


Route::get('test_notification','App\Http\Controllers\Admin\NotificationHandler@TestSendNotification');
Route::get('reg','App\Http\Controllers\Admin\NotificationHandler@subscribe');