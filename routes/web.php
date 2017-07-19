<?php

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

Route::get('/', 'WelcomeController@index');

Auth::routes();
 
Route::get('/home', 'HomeController@index');

Route::group(["prefix" => "shop"], function () {
    Route::get("/", [
        'uses' => "ShoppingCartController@showShopIndex",
        "as"   => "shop.index",
    ]);
    Route::get("seed", [
        "uses" => "ShoppingCartController@seed",
    ]);
    Route::get("add-to-cart/{id}", [
        'uses' => "ShoppingCartController@addToCart",
        "as"   => "shop.to-cart",
    ]);
    Route::get("mailorder/new/{id}", "ShoppingCartController@createOrderWithoutReg")->name('order-to-mail');
//cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get("/", [
            "uses" => "ShoppingCartController@showCart",
            "as"   => "shop.cart",
        ]);
        Route::get("/increment/{id}", [
            'uses' => "ShoppingCartController@incrementItemInCart",
        ]);
        Route::get("/decrement/{id}", [
            'uses' => "ShoppingCartController@decrementItemInCart",
        ]);
        Route::post("/checkout", [
            "uses" => "ShoppingCartController@checkout",
            "as"   => "checkout",
        ]);
    });
});
