<?php


Route::get('/', 'AdminController@index')->name('index');
Route::get('/home', 'AdminController@index')->name('index');
Route::get('/user', 'AdminController@user')->name('user');

Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');

Route::get('pdf', 'ProductController@pdf')->name('pdf');

Route::get('/cart-details', 'CartController@index')->name('cart.details');
Route::get('/cart-add', 'CartController@cart_add')->name('cart.add');
Route::get('/cart-update', 'CartController@cart_update')->name('cart.update');
Route::post('/cart-remove', 'CartController@cart_remove')->name('cart.remove');

