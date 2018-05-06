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
});

Route::group(['prefix' => 'garage'], function () {
    Route::get('', [
        'uses' => 'CarController@getGarageIndex',
        'as' => 'garage.index'
    ]);
});