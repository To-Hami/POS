<?php


use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {

    Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function (){
        Route::get('/index','dashboardController@index')->name('index');
        Route::get('index','welcomeController@index')->name('index');
        Route::resource('users','UserController')->except('show');
        Route::resource('categories','CategoryController')->except('show');
        Route::resource('products','ProductController')->except('show');
        Route::resource('clients','ClientController')->except('show');
        Route::resource('clients.orders','Client\OrderController')->except('show');
        Route::resource('orders','OrderController');
        Route::resource('reports','ReportsController');
//       Route::get('orders.products ','OrderController@products')->name('orders.products');
        Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');



    });
});



