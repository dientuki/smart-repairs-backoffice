<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['prefix' => 'admin'], function () {
    Auth::routes(['register' => false]);

    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard.html', ['uses' => 'DashboardController@index', 'as' => 'dashboard']);

        Route::resource('brands', 'BrandsController')->except(['show']);
        Route::resource('device-types', 'DeviceTypesController')->except(['show']);
        Route::resource('devices', 'DevicesController')->except(['show']);
        Route::resource('parts', 'PartsController')->except(['show']);

        Route::post('images', 'ImagesController@store')->name('images.store');
    });
});
