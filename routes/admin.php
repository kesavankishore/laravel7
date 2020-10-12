<?php


Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    
})->name('home');

Route::get('/', 'AdminController@index')->name('index');
Route::get('/home', 'AdminController@index')->name('index');



Route::resource('employee', 'EmployeeController');
Route::get('top-five', 'EmployeeController@topfive')->name('top-five');
Route::get('document-upload', 'EmployeeController@multiple')->name('document-upload');
Route::post('upload', 'EmployeeController@upload')->name('upload');
Route::get('document', 'EmployeeController@document')->name('document');
Route::delete('documentdocument-delete/{id}', 'EmployeeController@delete')->name('document-delete');
Route::get('email', 'EmployeeController@email')->name('email');
Route::post('send-mail', 'EmployeeController@send')->name('send-mail');

Route::resource('product', 'ProductController');



Route::get('order', 'ProductController@order')->name('order');
Route::get('code', 'ProductController@code')->name('code');
Route::get('words', 'ProductController@words')->name('words');
Route::get('calculate', 'ProductController@calculate')->name('calculate');
Route::post('orderStore', 'ProductController@orderStore')->name('orderStore');

Route::get('/cart-details', 'CartController@index')->name('cart.details');
Route::get('/cart-add', 'CartController@cart_add')->name('cart.add');
Route::get('/cart-update', 'CartController@cart_update')->name('cart.update');
Route::post('/cart-remove', 'CartController@cart_remove')->name('cart.remove');


Route::get('/cart-details', 'CartController@index')->name('cart.details');
Route::get('/cart-add', 'CartController@cart_add')->name('cart.add');
Route::get('/cart-update', 'CartController@cart_update')->name('cart.update');
Route::post('/cart-remove', 'CartController@cart_remove')->name('cart.remove');



