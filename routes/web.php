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

Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/products/create', 'ProductController@create')->name('product.create');
Route::get('/products/{product}', 'ProductController@show')->name('product.show');
Route::get('/products/{product}/edit', 'ProductController@edit')->name('product.edit');
Route::post('/products', 'ProductController@store')->name('product.store');
Route::delete('/products/{product}', 'ProductController@destroy')->name('product.destroy');
Route::patch('/products/{product}', 'ProductController@update')->name('product.update');

Route::get('/picture/create/{product}', 'PictureController@create')->name('picture.add');
Route::post('/picture/save-pictures/{product}', 'PictureController@dropzone')->name('picture.save');
Route::delete('/picture/{picture}/product/{product_id}', 'PictureController@destroy')->name('picture.destroy');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
