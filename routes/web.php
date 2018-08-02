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

Route::get('/', 'HomeController@index');

Route::prefix('store')->group(function() {
    Route::post('submititem', 'ItemsController@submitItem');
    Route::get('newitem', 'ItemsController@newitem');
    Route::get('packages', 'ViewMarketController@packages');
    Route::get('items', 'ViewMarketController@items');
    Route::get('item/{item}', 'ViewMarketController@item');
    Route::get('request/{item}', 'ViewMarketController@requestItemDisclaimer');
    Route::post('request/{item}', 'ViewMarketController@requestItem');
});

Route::prefix('eve')->group(function() {
    Route::get('auth', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/callback', 'Auth\LoginController@handleProviderCallback');
});
