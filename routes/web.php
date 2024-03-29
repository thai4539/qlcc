<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Middleware\CheckLogin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use UniSharp\LaravelFilemanager\Lfm;

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
Auth::routes();

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     Lfm::routes();
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.layouts.master');
    })->name('home');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('settings', SettingController::class);
});



Route::get('/', [HomeController::class, 'index'])->name('client.home');

Route::get('/category/{slug}', [HomeController::class, 'ShowCategory'])->name('client.category');

Route::get('/cart', [HomeController::class, 'ShowCart'])->name('client.cart');

Route::get('/checkout', [HomeController::class, 'showCheckout'])->name('client.checkout');

Route::get('/detail/{id}', [HomeController::class, 'getProductDetail'])->name('client.detail');

Route::get('/hi', function(){
    echo 12345;
});


