<?php


Route::get('/', 'AdminController@index')->name('index');
Route::get('/home', 'AdminController@index')->name('index');
Route::get('/user', 'AdminController@user')->name('user');

Route::resource('product', 'ProductController');
Route::resource('category', 'CategoryController');
Route::resource('employee', 'EmployeeController');
Route::get('top-five', 'EmployeeController@topfive')->name('top-five');
Route::get('document-upload', 'EmployeeController@multiple')->name('document-upload');
Route::post('upload', 'EmployeeController@upload')->name('upload');
Route::get('document', 'EmployeeController@document')->name('document');
Route::delete('documentdocument-delete/{id}', 'EmployeeController@delete')->name('document-delete');
Route::get('email', 'EmployeeController@email')->name('email');
Route::post('send-mail', 'EmployeeController@send')->name('send-mail');

Route::get('pdf', 'ProductController@pdf')->name('pdf');
Route::get('mail', 'ProductController@email')->name('mail');

Route::get('/cart-details', 'CartController@index')->name('cart.details');
Route::get('/cart-add', 'CartController@cart_add')->name('cart.add');
Route::get('/cart-update', 'CartController@cart_update')->name('cart.update');
Route::post('/cart-remove', 'CartController@cart_remove')->name('cart.remove');

