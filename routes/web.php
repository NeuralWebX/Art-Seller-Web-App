<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ACMController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SettingsController;

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

Route::prefix('authenticate')->name('backend.auth.')->group(function () {
    Route::get('/login', [BackendController::class, 'login'])->name('login');
    Route::post('/login-submit', [BackendController::class, 'loginSubmit'])->name('login.submit');
});
Route::name('backend.')->middleware('auth')->group(function () {
    Route::get('/logout', [BackendController::class, 'logout'])->name('logout');
    Route::get('/', [BackendController::class, 'index'])->name('index');
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::put('/update', [SettingsController::class, 'update'])->name('update');
    });
    Route::resource('user', UserController::class);
    Route::resource('role-permission', ACMController::class);
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::get('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });
});