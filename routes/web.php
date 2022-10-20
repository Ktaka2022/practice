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

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/product', 'ProductController@productView')->name('product');


// Auth::routes();

// Route::get('/productdetails', 'ProductController@productDetialsView')->name('productdetails');


Auth::routes();

Route::get('/productdetails/{id}', 'ProductController@productDetialsView')->name('productdetails');

Auth::routes();

Route::get('/productedit/{id}', 'ProductController@productEditView')->name('productedit');

Auth::routes();

Route::get('/productdelete/{id}','ProductController@productDelete')->name('productdelete');
// Auth::routes();

// Route::get('/editproduct','ProductController@productEdit')->name('editproduct');

Auth::routes();

Route::post('/editproduct', 'ProductController@productEdit')->name('editproduct');

Auth::routes();

Route::get('/newproduct', 'ProductController@productNewView')->name('newproduct');

Auth::routes();

Route::post('/productcreate', 'ProductController@productNewCreate')->name('productcreate');

Auth::routes();

Route::post('/productsearch', 'ProductController@productSearch')->name('productsearch');
