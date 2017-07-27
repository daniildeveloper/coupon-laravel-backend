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
Route::group(['prefix' => 'seller' /**'middleware' => 'auth'*/], function () {
    // seller dashoard. Here is to view all data quickly.
    Route::get('dashboard', 'SellerController@showSellerDashboard')->name('seller.dashboard');

    // seller coupons
    Route::group(['prefix' => 'coupon'], function () {
        //  show seller coupons
        Route::get('/', 'SellerController@showSellerCoupons')->name('seller.coupons');

        // confirm coupon
        Route::get('confirm', 'SellerController@confirmCoupon')->name('seller.coupons.confirm');

        // NEW COUPON CREATION FORM
        Route::get('new', 'SellerController@showSellerCouponCreationView')->name('seller.coupon.new');

        // CREATE COUPON
        Route::post('create', 'SellerController@createCoupon')->name('seller.coupon.create');

        // show edit coupon view
        Route::get('edit/{id}', 'SellerController@editCoupon')->name('seller.coupon.edit');

        // update coupon
        Route::post('update', 'SellerController@updateCoupon')->name('seller.coupon.update');
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
    Route::group(['prefix' => 'accounting'], function () {
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
    // END SELLER CLIENTS

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
    // Route::get('/', function () {
    //     return view('auth.login');
    // });

    // qiwi payments
    Route::group(['prefix' => 'qiwi'], function () {
        Route::get('gate', 'QiwiController@checkOrder')->name('pay.qiwi.gateurl');
    });
    // end qiwi payments

    /**
     * KKB payments
     */
    Route::group(['prefix' => 'kkb'], function () {
        Route::get('/', 'QazKomController@pay')->name('pay.kkb');
    });
    /**
     * END KKB PAYMENTS
     */
});
/**
 * ================================
 *     END PAYMENTS
 * ================================
 */

/**
 * ===============================
 *     ADMIN
 * ===============================
 */
Route::group([
    'prefix'     => 'manager',
    'namespace'  => 'Admin',
    'middleware' => 'admin',
], function () {
    // SHOW ADMIN DASHBOARD
    Route::get('/', 'AdminController@showDashboard')->name('admin.dashboard');

    Route::group(["prefix" => 'trash'], function () {
        Route::get("/", "TrashController@showTrash")->name("trash");
        Route::get("/restore/{id}", 'TrashController@restore')->name("trash.restore");
        Route::get("/to/{table}/{id}", "TrashController@moveToTrash")->name('trash.moveTo');
        Route::get("/delete/{id}", "TrashController@delete")->name("trash.delete");
    });

    Route::group(["prefix" => "faq"], function () {
        Route::get("/", "FaqController@get")->name("faq.all");
        Route::get("/edit/{id}", "FaqController@formEdit")->name("faq.edit");
        Route::get("new", "FaqController@form")->name("faq.new");
        Route::get("create", "FaqController@create")->name("faq.create");
        Route::get("update", "FaqController@update")->name("faq.update");
        Route::get("toggle/{id}", "FaqController@toggleShowInFooter")->name("faq.toggle");
        Route::get("footerpos", "FaqController@setFooterPos")->name("faq.footerpos");
    });

    Route::group(["prefix" => "news"], function () {
        Route::get("/", "NewsController@get")->name("news.all");
        Route::get("/edit/{id}", "NewsController@formEdit")->name("news.edit");
        Route::get("new", "NewsController@form")->name("news.new");
        Route::get("create", "NewsController@create")->name("news.create");
        Route::get("update", "NewsController@update")->name("news.update");
    });

    Route::group(["prefix" => "couponcategories"], function () {
        Route::get("/", "ContentController@showCategories")->name("categories.all");
        Route::get("/update/{id}", "ContentController@updateCategory")->name("categories.update");
    });

    Route::group(["prefix" => "settings"], function () {
        Route::get("/", "SystemSettingController@showAll")->name("setting.all");
        Route::get("/update", "SystemSettingController@updateSetting")->name("setting.update");
    });

    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', 'AdminController@allCoupons')->name('crud-coupon');
        Route::get("/unconfirmed", "AdminController@showNewCoupons")->name('coupons-unconfirmed');
        Route::get('/publish/{id}', "AdminController@publishCoupon")->name('coupon-p');
        Route::get('/hide/{id}', "AdminController@hideCoupon")->name('coupon-h');
        Route::get("/{id}", "AdminController@showSingleCoupon")->name("single-coupon");
        Route::get("/{id}/setPrice", "AdminController@setCouponPrice")->name('coupon-price');

        // создание купонов из админки
        Route::group(["prefix" => "coupon"], function () {
            Route::get("showform", "CouponCompanyController@showCouponCreationForm")->name("admin-create-coupon");
            Route::post("create", "CouponCompanyController@createCoupon")->name("coupon.fromadmin");
            Route::group(["prefix" => "categories"], function () {
                Route::get("/", "AdminController@showCategories")->name("admin.categories");
            });
        });
    });

    Route::group(['prefix' => 'company'], function () {
        Route::group(['prefix' => 'type'], function () {
            Route::get("/", "CouponCompanyController@showCompanyTypes")->name('companytypes');
            Route::get("/edit/{id}", "CouponCompanyController@editCompanyType")->name("companytypes.edit");
            Route::get("new", "CouponCompanyController@newCompanyType")->name('companytypes.new');
            Route::get("/create", "CouponCompanyController@createCompanyType")->name("companytypes.create");
            Route::get("/update", "CouponCompanyController@udpateCompanyType")->name("companytypes.update");
            Route::get("/delete/{id}", "CouponCompanyController@deleteCompanyType")->name("companytypes.delete");
        });
        Route::get('/', 'AdminController@allComapanies')->name('crud-company');
        Route::get("/unconfirmed", "AdminController@showUnconfirmedCompanies")->name("unconfirmed-companies");
        Route::get("/toFamily/{id}", "AdminController@toTheFamily")->name("to-family");
        Route::get("/companylist", "CouponCompanyController@getCompaniesForAutoComplete");
        Route::get('/company/{id}', 'AdminController@showCompanieById')->name('crud-company-single');

    });

    Route::group(['prefix' => 'ref'], function () {
        Route::get('/', "AdminController@showReferalSettings")->name('crud-ref-setup');
        Route::get('/all', "AdminController@showReferalList")->name('crud-crud-ref-list');
        Route::get('/back', "AdminController@showReferalPayList")->name('crud-ref-payments');
    });
    Route::get('types', "AdminController@showTypes")->name('type');

    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', 'PaymentsController@showLast')->name('payments');
        Route::get('settings', "PaymentsController@showSettings")->name('pay-set');
        Route::post('settings', "PaymentsController@changeData")->name('pay-change');
        Route::get("find", "PaymentsController@findPayment")->name("payment.find");
    });

    Route::group(["prefix" => "topbanner"], function () {
        Route::get("/", "BannerController@showBannerSettings")->name("banner-top");
        Route::post("/banner", "BannerController@updateBanner")->name("banner-update");
    });
});
/**
 *  END ADMIN
 */
