<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ACMController;
use App\Http\Controllers\backend\ShopController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SettingsController;
use App\Http\Controllers\SslCommerzPaymentController;

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
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('role-permission')->name('role-permission.')->group(function () {
        Route::get('/', [ACMController::class, 'index'])->name('index');
        Route::get('/create', [ACMController::class, 'create'])->name('create');
        Route::post('/store', [ACMController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ACMController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ACMController::class, 'update'])->name('update');
        Route::get('/destroy/{id}', [ACMController::class, 'delete'])->name('destroy');
    });
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::get('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('show');
        Route::get('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('shop')->name('shop.')->group(function () {
        Route::get('/', [ShopController::class, 'index'])->name('index');
        Route::get('/preview/{product}', [ShopController::class, 'preview'])->name('preview');
    });
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/{product}', [OrderController::class, 'index'])->name('index');
        Route::post('/place/{product}', [OrderController::class, 'order'])->name('order');
    });
    // SSLCOMMERZ Start
    Route::prefix('online-pay')->name('onlinePay.')->group(function () {
        Route::get('/example1/{product}', [SslCommerzPaymentController::class, 'exampleEasyCheckout'])->name('exampleEasyCheckout');
        Route::get('/example2/{product}', [SslCommerzPaymentController::class, 'exampleHostedCheckout'])->name('exampleHostedCheckout');
        Route::post('/pay/{product}', [SslCommerzPaymentController::class, 'index'])->name('payNow');
        Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('payViaAjax');
        Route::get('/success', [SslCommerzPaymentController::class, 'success'])->name('success');
        Route::post('/fail', [SslCommerzPaymentController::class, 'fail'])->name('fail');
        Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('cancel');
        Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn'])->name('ipn');
    });
});
