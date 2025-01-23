<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmailVerificationController;

Route::get('/verify', [EmailVerificationController::class, 'show'])->middleware('auth', 'verified');




Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


// 商品のルート
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// カートのルート
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');  // カートページを表示
    Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');  // 商品をカートに追加するページ
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');  // カートにアイテムを追加
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');  // カートからアイテムを削除
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');  // カートアイテムの更新
});

// チェックアウトのルート
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/session', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

// コンタクトフォームのルート
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// 認証ルート
Auth::routes();

// ホームページのルート
Route::get('/', function () {
    return view('welcome');
});
// Aboutページのルート
Route::get('/about', function () {
    return view('about');
});
// routes/web.php
Auth::routes(['verify' => true]);

// 認証後のホームページ
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
