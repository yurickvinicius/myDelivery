<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
///Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/logoutTest', 'Auth\AuthController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', 'PizzeriaController@index');

Route::get('order/pagseguro/{code}', ['as' => 'pizza.pagseguro', 'uses' => 'PizzeriaController@getPagSeguro']);
Route::get('order', ['as' => 'pizza.order', 'uses' => 'PizzeriaController@order']);
Route::post('store', ['as' => 'pizza.store', 'uses' => 'PizzeriaController@store']);

////

Route::group(['prefix' => 'admin', 'middleware' => 'authPizzeria', 'as' => 'admin.', 'where' => ['id' => '[0-9]+']], function() {
    
    Route::get('', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);
    Route::get('flavors', ['as' => 'flavors.index', 'uses' => 'FlavorsController@index']);
    Route::get('flavors/create', ['as' => 'flavors.create', 'uses' => 'FlavorsController@create']);
    Route::post('flavors/store', ['as' => 'flavors.store', 'uses' => 'FlavorsController@store']);
    Route::get('flavors/edit/{id}', ['as' => 'flavors.edit', 'uses' => 'FlavorsController@edit']);
    Route::post('flavors/update/{id}', ['as' => 'flavors.update', 'uses' => 'FlavorsController@update']);
    Route::get('flavors/destroy/{id}', ['as' => 'flavors.destroy', 'uses' => 'FlavorsController@destroy']);
    Route::get('flavors/{id}/images', ['as' => 'flavors.images', 'uses' => 'FlavorsController@images']);
    Route::get('flavors/{id}/images/create', ['as' => 'flavors.images.create', 'uses' => 'FlavorsController@createImage']);
    Route::post('flavors/{id}/images/store', ['as' => 'flavors.images.store', 'uses' => 'FlavorsController@storeImage']);
    Route::get('flavor/image/{id}/destroy', ['as' => 'flavor.image.destroy', 'uses' => 'FlavorsController@destroyImage']);

    Route::get('drinks', ['as' => 'drinks.index', 'uses' => 'DrinksController@index']);
    Route::get('drinks/create', ['as' => 'drinks.create', 'uses' => 'DrinksController@create']);
    Route::post('drinks/store', ['as' => 'drinks.store', 'uses' => 'DrinksController@store']);
    Route::get('drinks/edit/{id}', ['as' => 'drinks.edit', 'uses' => 'DrinksController@edit']);
    Route::post('drinks/update/{id}', ['as' => 'drinks.update', 'uses' => 'DrinksController@update']);
    Route::get('drinks/destroy/{id}', ['as' => 'drinks.destroy', 'uses' => 'DrinksController@destroy']);

    Route::get('edges', ['as' => 'edges.index', 'uses' => 'EdgesController@index']);

    Route::get('sizes', ['as' => 'sizes.index', 'uses' => 'SizesController@index']);
});

Route::group(['middleware' => 'authPizzeria', 'where' => ['id' => '[0-9]+']], function() {

    Route::get('orders', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);
    Route::get('order/{id}/show', ['as' => 'order.show', 'uses' => 'OrdersController@show']);
    Route::post('order/send', ['as' => 'order.send', 'uses' => 'OrdersController@sendOrder']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'OrdersController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'OrdersController@store']);
    
    Route::get('flavor/{id}/show', ['uses' => 'FlavorsController@showJson']);
        
});
