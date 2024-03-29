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

Route::group(['prefix' => 'masters', 'as' => 'master.','middleware' => 'admin'], function () {
    Route::get('/', 'MastersController@index');
    Route::resource('/account-groups', 'AccountGroupController');
    Route::resource('/accounts', 'AccountMasterController');
    Route::resource('/items', 'ItemMasterController');
    Route::resource('/items-group', 'ItemGroupMasterController');
    Route::resource('/units', 'UnitMasterController');
    Route::resource('/hsn', 'HSNMasterController');
    Route::resource('/company', 'CompanyController');
});

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::get('/get-item-by-id/{id?}', 'AjaxController@getItemByID')->name('get-item-by-id');
    Route::get('/get-state-by-country', 'AjaxController@getStateByCountry')->name('get-state-by-country');
    Route::get('/get-city-by-state', 'AjaxController@getCityByState')->name('get-city-by-state');
    Route::get('/get-account-by-id/{id?}', 'AjaxController@getAccountById')->name('get-account-by-id');
});
