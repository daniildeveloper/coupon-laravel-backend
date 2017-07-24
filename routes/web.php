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
 * ===============================
 *         HELPERS
 * ===============================
 */
Route::get('/links', function () {
    return view('links');
})->name('links');

Route::get('thanks', 'WelcomeController@thanks')->name('thanks');
/**
 * ===============================
 *         END HELPERS
 * ===============================
 */

/**
 * ================================
 *         ROUTES FOR SELLER
 * ================================
 */
// view to register seller
Route::get('register-seller', 'SellerController@showRegisterView')->name('seller.register.view');
// register seller
Route::post('register-seller', 'SellerController@register')->name('seller.register');

// Routes group
Route::group(['prefix' => 'seller', /**'middleware' => 'auth'*/], function () {
    // seller dashoard. Here is to view all data quickly.
    Route::get('dashboard', 'SellerController@showSellerDashboard')->name('seller.dashboard');

    // seller coupons
    Route::group(['prefix' => 'coupon'], function () {
        //  show seller coupons
        Route::get('/', 'SellerController@showSellerCoupons')->name('seller.coupons');

        // confirm coupon
        Route::get('confirm', 'SellerController@confirmCoupon')->name('seller.coupons.confirm');
    });

    // seller managers
    Route::group(['prefix' => 'managers'], function () {
        // show all managers
        Route::get('/', 'SellerController@showManagers')->name('seller.managers');
        // TODO: invite manager per email
        // TODO: manager single cabinet with photo upload, contacts, and chat link
        // TODO: managers stats
    });
    // end seller managers

    // sellers coupon orders
    // here are coupons orders history. To plan how many comes from CouponLand
    Route::get('orders', 'SellerController@showOrders')->name('seller.orders');

    // clients
    Route::group(['prefix' => 'clients'], function () {
        // clients list
        Route::get('/', 'SellerController@showClients')->name('seller.clients.top20');
        // TODO: make coupon with additional sale/special price
        // TODO: invite to event
        // TODO: send gift(gift-code, special offer, gift-ware)
    });
    // End clients

    // payments
    Route::group(['prefix' => 'payments'], function () {
        // show all payments
        Route::get('/', 'SellerController@showPayments')->name('seller.payments');
        // take money to cart
        Route::get('/out', 'SellerController@out')->name('seller.payments.out');;
        // TODO: make payment
        // TODO: my money
    });
    // end payments
    
    // accounting
    Route::group(['prefix' => 'accounting'], function() {
        //list with possible exels
        Route::get('/', 'SellerController@showAccountingDataList')->name('accounting');
        // TODO: generate exel with views and buys
        // TODO: generate exels with manager statistics
        // TODO: generate exel with payments history
        // TODO: generate exel with all time or selected time views, buys, and sells statistics
    });
    // end accounting
    
    // SELLER CLIENTS
    Route::group(['prefix' => 'clients'], function () {
        Route::get('/', 'SellerController@showClientsList')->name('seller.clients');
    });
    
    // TODO: messenger

});

/**
 * ================================
 *         END ROUTES FOR SELLER
 * ================================
 */


 /* ================================
 *     PAYMENTS
 * ================================
 */
Route::group(['prefix' => 'pay', 'namespace' => 'Payments'], function () {
    Route::get('/', function () {
        return view('auth.login');
    });

    // qiwi payments
    Route::group(['prefix' => 'qiwi'], function () {
        Route::get('gate', 'QiwiController@checkOrder')->name('pay.qiwi.gateurl');
    });
    // end qiwi payments
});
/**
 * ================================
 *     END PAYMENTS
 * ================================
 */