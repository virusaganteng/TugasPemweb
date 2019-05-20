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

Route::get('/',  'IndexController@index');

Route::get('/product/{id}', 'IndexController@product');

Route::get('/cart', 'IndexController@cart');
Route::get('/addtocart/{id}', 'IndexController@addtocart');
Route::get('/apus', 'IndexController@apus');
Route::get('/checkout', 'IndexController@checkout');
Route::post('/addcheckout', 'IndexController@addcheckout');
route::post('/checkoutproses', 'IndexController@checkoutproses');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add', 'HomeController@add');
Route::post('/addpost', 'HomeController@addpost')->name('addpost');
Route::get('/kelola', 'HomeController@kelola');
Route::get('/orderdetail', 'HomeController@orderdetail');
Route::get('/contact', function(){
	return view('contact');
});
Route::get('/delete/{id}', 'HomeController@delete');
