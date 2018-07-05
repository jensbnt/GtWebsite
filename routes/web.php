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

Route::get('/', function () {
    return view('pages.index');
})->name('pages.index');

Route::group(['prefix' => 'cars'], function () {
    Route::get('', [
        'uses' => 'CarController@getCarsIndex',
        'as' => 'cars.index'
    ]);

    Route::get('view/{id}', [
        'uses' => 'CarController@getCarsView',
        'as' => 'cars.view'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'CarController@getCarsEdit',
        'as' => 'cars.edit'
    ]);

    Route::post('edit/{id}', [
        'uses' => 'CarController@postCarsEdit',
        'as' => 'cars.edit'
    ]);

    Route::get('new', [
        'uses' => 'CarController@getCarsNew',
        'as' => 'cars.new'
    ]);

    Route::post('new', [
        'uses' => 'CarController@postCarsNew',
        'as' => 'cars.new'
    ]);
});

Route::group(['prefix' => 'stats'], function () {
    Route::get('', [
        'uses' => 'CarController@getStatsIndex',
        'as' => 'stats.index'
    ]);
});

Route::group(['prefix' => 'api'], function () {
    Route::get('makes', [
        'uses' => 'ApiController@apiMakesIndex'
    ]);

    Route::get('makes/{make}', [
        'uses' => 'ApiController@apiMakesGet'
    ]);

    Route::get('categories/', [
        'uses' => 'ApiController@apiCategoriesIndex'
    ]);

    Route::get('categories/{category}', [
        'uses' => 'ApiController@apiCategoriesGet'
    ]);

    Route::get('drives/', [
        'uses' => 'ApiController@apiDrivesIndex'
    ]);

    Route::get('drives/{drive}', [
        'uses' => 'ApiController@apiDrivesGet'
    ]);
});