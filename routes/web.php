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

Route::get('/', 'IndexController@index', function () {
    return view('index');
});

Route::get('/product', function (){
    return view('product');
});
Route::group([
    'prefix' => 'customer',
     'as' => 'customer.'
    ], function (){
    Route::get('/login', function (){
        return view('customer.index');
    });
    Route::get('/daftar', function (){
        return view('customer.daftar');

    });
});