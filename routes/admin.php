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



