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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function(){

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product', 'ProductController@productView')->name('product');

// Route::get('/productdetails', 'ProductController@productDetialsView')->name('productdetails');

Route::get('/productdetails/{id}', 'ProductController@productDetialsView')->name('productdetails');

Route::get('/productedit/{id}', 'ProductController@productEditView')->name('productedit');

Route::get('/productdelete/{id}','ProductController@productDelete')->name('productdelete');

// Route::get('/editproduct','ProductController@productEdit')->name('editproduct');

Route::post('/editproduct', 'ProductController@productEdit')->name('editproduct');

Route::get('/newproduct', 'ProductController@productNewView')->name('newproduct');

Route::post('/productcreate', 'ProductController@productNewCreate')->name('productcreate');

Route::post('/productsearch', 'ProductController@productSearch')->name('productsearch');

});