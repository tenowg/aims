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

use App\Http\Middleware\AllianceMember;

Route::get('/', 'HomeController@index');

Route::prefix('store')->group(function() {
    Route::middleware(AllianceMember::class)->group(function() {
        Route::post('submititem', 'ItemsController@submitItem');
        Route::get('newitem', 'ItemsController@newitem');    
        Route::get('packages', 'ViewMarketController@packages');
        Route::get('items', 'ViewMarketController@items');
        Route::get('item/{item}', 'ViewMarketController@item');
        Route::get('request/{item}', 'ViewMarketController@requestItemDisclaimer');
        Route::post('request/{item}', 'ViewMarketController@requestItem');
        Route::post('buyitems/{package}', 'ViewMarketController@requestItems');
    });
    Route::get('package/{package}', 'ViewMarketController@package');
});

Route::prefix('eve')->group(function() {
    Route::get('auth', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/callback', 'Auth\LoginController@handleProviderCallback');
    Route::get('logout', 'Auth\LoginController@logout');
});

Route::prefix('errors')->group(function() {
    Route::view('nonalliancemember', 'errors.nonalliancemember');
});
