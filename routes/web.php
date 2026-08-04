<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@index')->name("admin.index");

Route::get('/admin/food', 'App\Http\Controllers\Admin\FoodController@index')->name("food.index");

Route::post('/admin/food', 'App\Http\Controllers\Admin\FoodController@add')->name("food.add");
Route::delete('/admin/food/{id}', 'App\Http\Controllers\Admin\FoodController@delete')->name("food.delete");
Route::put('/admin/food/{id}', 'App\Http\Controllers\Admin\FoodController@edit')->name("food.edit");

Route::get('/admin/food/new', 'App\Http\Controllers\Admin\FoodController@new')->name("food.new");
Route::get('/admin/food/{id}', 'App\Http\Controllers\Admin\FoodController@info')->name("food.info");

Route::get('/admin/category', 'App\Http\Controllers\Admin\CategoryController@index')->name("category.index");
Route::get('/admin/category/new', 'App\Http\Controllers\Admin\CategoryController@new')->name("category.new");

Route::get('/admin/order', 'App\Http\Controllers\Admin\AdminController@order')->name("admin.order");
Route::get('/admin/employee', 'App\Http\Controllers\Admin\AdminController@employee')->name("admin.employee");
Route::get('/admin/profile', 'App\Http\Controllers\Admin\AdminController@profile')->name("admin.profile");

Route::get('/cart/purchase', 'App\Http\Controllers\Client\CartController@purchase')->name('cart.purchase');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client/{FOD_ID}', [App\Http\Controllers\Client\FoodController::class, 'show'])->name('client.show');
Route::get('/', [App\Http\Controllers\Client\FoodController::class, 'index'])->name('client.index');

Route::get('/cart', 'App\Http\Controllers\Client\CartController@index')->name('cart.index');
Route::post('/cart/add/{id}', 'App\Http\Controllers\Client\CartController@add')->name('cart.add');
Route::get('/cart/delete', 'App\Http\Controllers\Client\CartController@delete')->name('cart.delete');

