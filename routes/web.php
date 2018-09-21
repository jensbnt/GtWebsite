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

Route::get('/', [
    'uses' => 'CarController@getHomePage',
    'as' => 'pages.index'
]);

/** CARS */

Route::group(['prefix' => 'cars'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'CarController@getCarsIndex',
        'as' => 'cars.index'
    ]);

    // VIEW

    Route::get('view/{id}', [
        'uses' => 'CarController@getCarsView',
        'as' => 'cars.view'
    ]);

    Route::post('view/{id}', [
        'uses' => 'CarController@postCarsView',
        'as' => 'cars.view'
    ]);

    // EDIT

    Route::get('edit/{id}', [
        'uses' => 'CarController@getCarsEdit',
        'as' => 'cars.edit'
    ]);

    Route::post('edit/{id}', [
        'uses' => 'CarController@postCarsEdit',
        'as' => 'cars.edit'
    ]);

    // NEW

    Route::get('new', [
        'uses' => 'CarController@getCarsNew',
        'as' => 'cars.new'
    ]);

    Route::post('new', [
        'uses' => 'CarController@postCarsNew',
        'as' => 'cars.new'
    ]);
});

/** STATS */

Route::group(['prefix' => 'stats'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'StatController@getStatsIndex',
        'as' => 'stats.index'
    ]);
});

/** COMPARE */

Route::group(['prefix' => 'compare'], function () {
    // INDEX

    Route::get('', [
        'uses' => 'CompareController@getCompareIndex',
        'as' => 'compare.index'
    ]);

    Route::post('', [
        'uses' => 'CompareController@postCompareIndex',
        'as' => 'compare.index'
    ]);
});

/** API */

Route::group(['prefix' => 'api'], function () {
    // MAKES

    Route::get('makes', [
        'uses' => 'ApiController@apiMakesIndex'
    ]);

    Route::get('makes/{make}', [
        'uses' => 'ApiController@apiMakesGet'
    ]);

    // CATEGORIES

    Route::get('categories/', [
        'uses' => 'ApiController@apiCategoriesIndex'
    ]);

    Route::get('categories/{category}', [
        'uses' => 'ApiController@apiCategoriesGet'
    ]);

    // DRIVES

    Route::get('drives/', [
        'uses' => 'ApiController@apiDrivesIndex'
    ]);

    Route::get('drives/{drive}', [
        'uses' => 'ApiController@apiDrivesGet'
    ]);
});