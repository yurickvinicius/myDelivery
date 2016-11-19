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

 // Rotas para solicitar trocar de senha...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Rotas para trocar a senha...
Route::get('password/reset/{token}', 'PasswordController@getReset');
Route::post('password/reset', 'PasswordController@postReset');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/logoutTest', 'Auth\AuthController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/', 'PizzeriaController@index');

Route::get('order/pagseguro/{code}', ['as' => 'pizza.pagseguro', 'uses' => 'PizzeriaController@getPagSeguro']);
Route::get('order', ['as' => 'pizza.order', 'uses' => 'PizzeriaController@order']);
Route::post('store', ['as' => 'pizza.store', 'uses' => 'PizzeriaController@store']);

////

Route::group(['prefix' => 'admin', 'middleware' => 'authSystem', 'as' => 'admin.', 'where' => ['id' => '[0-9]+']], function() {

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
    Route::get('edges/create', ['as' => 'edges.create', 'uses' => 'EdgesController@create']);
    Route::post('edges/store', ['as' => 'edges.store', 'uses' => 'EdgesController@store']);
    Route::get('edges/edit/{id}', ['as' => 'edges.edit', 'uses' => 'EdgesController@edit']);
    Route::post('edges/update/{id}', ['as' => 'edges.update', 'uses' => 'EdgesController@update']);
    Route::get('edges/destroy/{id}', ['as' => 'edges.destroy', 'uses' => 'EdgesController@destroy']);

    Route::get('sizes', ['as' => 'sizes.index', 'uses' => 'SizesController@index']);
    Route::get('sizes/create', ['as' => 'sizes.create', 'uses' => 'SizesController@create']);
    Route::post('sizes/store', ['as' => 'sizes.store', 'uses' => 'SizesController@store']);
    Route::get('sizes/edit/{id}', ['as' => 'sizes.edit', 'uses' => 'SizesController@edit']);
    Route::post('sizes/update/{id}', ['as' => 'sizes.update', 'uses' => 'SizesController@update']);
    Route::get('sizes/destroy/{id}', ['as' => 'sizes.destroy', 'uses' => 'SizesController@destroy']);

    Route::get('deliverymeans', ['as' => 'deliverymeans.index', 'uses' => 'DeliveryMeansController@index']);
    Route::get('deliverymeans/create', ['as' => 'deliverymeans.create', 'uses' => 'DeliveryMeansController@create']);
    Route::post('deliverymeans/store', ['as' => 'deliverymeans.store', 'uses' => 'DeliveryMeansController@store']);
    Route::get('deliverymeans/edit/{id}', ['as' => 'deliverymeans.edit', 'uses' => 'DeliveryMeansController@edit']);
    Route::post('deliverymeans/update/{id}', ['as' => 'deliverymeans.update', 'uses' => 'DeliveryMeansController@update']);
    Route::get('deliverymeans/destroy/{id}', ['as' => 'deliverymeans.destroy', 'uses' => 'DeliveryMeansController@destroy']);

    Route::get('reports/orders', ['as' => 'reports.index', 'uses' => 'ReportsController@index']);
    Route::post('reports/orders', ['as' => 'reports.orders', 'uses' => 'ReportsController@reportOrders']);

    Route::get('users', ['as' => 'users.index', 'uses' => 'UsersController@index']);
    Route::get('users/create', ['as' => 'users.create', 'uses' => 'UsersController@create']);
    Route::post('users/store', ['as' => 'users.store', 'uses' => 'UsersController@store']);
    Route::get('users/edit/{id}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
    Route::post('users/update/{id}', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::get('users/destroy/{id}', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);
});

Route::group(['middleware' => 'authSystem', 'where' => ['id' => '[0-9]+']], function() {

    Route::get('orders', ['as' => 'orders.index', 'uses' => 'OrdersController@index']);
    Route::get('order/{id}/show', ['as' => 'order.show', 'uses' => 'OrdersController@show']);
    Route::post('order/send', ['as' => 'order.send', 'uses' => 'OrdersController@sendOrder']);
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'OrdersController@create']);
    Route::post('order/store', ['as' => 'order.store', 'uses' => 'OrdersController@store']);
    Route::get('order/cancel/{id}', ['as' => 'order.cancel', 'uses' => 'OrdersController@cancelOrder']);

    Route::get('flavor/{id}/show', ['uses' => 'FlavorsController@showJson']);

    ///Route::get('user/search/client/{data}', ['uses' => 'UsersController@searchClient']);

    Route::get('client/search/{data}', ['uses' => 'ClientsController@searchClient']);

});
