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
Route::get('/home', 'WelcomeController@index');

/**
 * Cabinet for seller and buyer
 */
Route::get("/cabinet", "CabinetController@showCabinet")->name("cabinet");
/**
 * Cabinet for seller and buyer
 */

Auth::routes();

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
        ])->name('cart.increment');
        Route::get("/decrement/{id}", [
            'uses' => "ShoppingCartController@decrementItemInCart",
        ])->name('cart.decrement');
        Route::post("/checkout", [
            "uses" => "ShoppingCartController@checkout",
            "as"   => "checkout",
        ]);
    });
});

/**
 * ====================
 *     FAVORITES
 * ====================
 */
Route::group(['prefix' => 'favorites'], function () {
    Route::get('/', 'FavoritesController@index')->name('favorites');
    Route::get('/add/{id}', 'FavoritesController@addToFavorites')->name('favorites.add');
    Route::get('/remove/{id}', 'FavoritesController@removeFromFavorites')->name('favorites.remove');
});
/**
 * ====================
 *     END FAVORITES
 * ====================
 */

Route::group(['prefix' => 'c'], function () {
    Route::get('/', 'CouponController@showAllCoupons')->name('c-all');
    Route::get('/add', 'CompanyController@showNewCouponForm')->name('c-add');
    Route::post('/new', 'CompanyController@createCoupon')->name('c-new');
    Route::get("/c/{cat}", "WelcomeController@showCategorie")->name("category");
    Route::get('/{id}', "WelcomeController@showSingleCoupon");
});

Route::group(['prefix' => 'company'], function () {
    Route::get('new', 'WelcomeController@showRegisterCompanyView');
    Route::post('add', 'WelcomeController@registerCompany')->name('company-reg');
    Route::get('my', "CompanyController@showMyCompany")->name('my-company');
});

Route::get('search', 'WelcomeController@search')->name("search");
Route::get("blog", "WelcomeController@blog")->name('blog');
Route::get("faq", 'WelcomeController@faq')->name("faq");
Route::get("newspaper", "WelcomeController@showNewsPaper");

/**
 * ================================
 *         ROUTES FOR SELLER
 * ================================
 */
// view to register seller
Route::get('register-seller', 'SellerController@showRegisterView')->name('seller.register.view');
// register seller
Route::post('register-seller', 'SellerController@register')->name('seller.register');

/**
 * ================================
 *         END ROUTES FOR SELLER
 * ================================
 */
