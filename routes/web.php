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
    return view('customers');
});




Route::get('api/customers/get_all' , 'CustomerController@get_all_customers');
Route::post('api/customers/add' , 'CustomerController@add_customer');
Route::put('api/customers/update/{id}' , 'CustomerController@update_customer');
Route::delete('api/customers/delete/{id}' , 'CustomerController@delete_customer');




/*
Route::get('/', function () {
    return view('welcome');
});

Route::resource('/book', 'BookController');
*/