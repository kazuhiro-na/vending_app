<?php

use Illuminate\Support\Facades\Route;

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
//商品一覧表示画面のルート
Route::get('/products', 'productsController@index')->name('products.index');
//商品登録画面のルート
Route::get('/products/create', 'ProductsController@create')->name('products.create');
//商品登録処理のルート
Route::post('/products', 'ProductsController@store')->name('products.store');
//商品詳細表示画面のルート
Route::get('/products/{product}', 'ProductsController@show')->name('products.show');
//商品編集画面のルート
Route::get('/products/{product}/edit', 'ProductsController@edit')->name('products.edit');
//商品更新処理のルート
Route::put('/products/{product}', 'ProductsController@update')->name('products.update');
//商品削除処理のルート
Route::delete('/products/{product}', 'ProductsController@destroy')->name('products.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
