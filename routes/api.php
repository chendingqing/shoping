<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::namespace('api')->group(function () {
    // 在 "App\Http\Controllers\api" 命名空间下的控制器
    //店铺列表路由
    Route::get('/shop/list', "ShopController@list")->name("shop.list");
    Route::get('/shop/index', "ShopController@index")->name("shop.index");

  //会员路由
    Route::any('/member/reg', "MemberController@reg")->name("member.reg");
    Route::any('/member/sms', "MemberController@sms")->name("member.sms");
    Route::any('/member/login', "MemberController@login")->name("member.login");
    Route::any('/member/remember', "MemberController@remember")->name("member.remember");
    Route::any('/member/update', "MemberController@update")->name("member.update");
    Route::any('/member/index', "MemberController@index")->name("member.index");



    //添加地址路由
    Route::any('/address/add', "AddressController@add")->name("address.add");
    Route::any('/address/list', "AddressController@list")->name("address.list");
    Route::any('/address/editAddress', "AddressController@editAddress")->name("address.editAddress");
    Route::any('/address/edit', "AddressController@edit")->name("address.edit");



    //添加购物车
    Route::any('/cart/add', "CartController@add")->name("cart.add");
    Route::any('/cart/list', "CartController@list")->name("cart.list");
    Route::any('/cart/list', "CartController@list")->name("cart.list");


    //生成订单
    Route::any('/order/add', "OrderController@add")->name("order.add");
    Route::any('/order/list', "OrderController@list")->name("order.list");
    Route::any('/order/find', "OrderController@find")->name("order.find");
    //支付
    Route::any('/order/pay', "OrderController@pay")->name("order.pay");
    Route::any('/order/wxPay', "OrderController@wxPay")->name("order.wxPay");
    Route::any('/order/wxPay', "OrderController@wxPay")->name("order.wxPay");
    Route::any('/order/ok', "OrderController@ok")->name("order.ok");
    Route::any('/order/status', "OrderController@status")->name("order.status");
});
