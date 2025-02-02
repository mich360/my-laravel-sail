<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
// routes/web.php
use App\Http\Controllers\AdminController;

Route::resource('carts', CartController::class);
// 管理者専用ページ
Route::middleware(['auth', 'is_admin'])->get('/admin', [AdminController::class, 'index'])->name('admin.index');

// 認証されたユーザーが自分の情報だけにアクセスできるように
Route::middleware(['auth'])->get('/user/{id}', function ($id) {
    if (Auth::id() != $id) {
        abort(403, 'Unauthorized action.');
    }
    return (new UserController())->show($id); // 自分の情報を表示
})->name('user.show');

// Route::get('/user/{id}', [UserController::class, 'show']);


Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('checkout', [CheckoutController::class, 'process'])->name('checkout.process');

Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');


Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth'])->name('settings');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return 'Dashboardページが未実装です。';
// })->middleware(['auth'])->name('dashboard');


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
// 認証ルート（メール確認を有効化）
Auth::routes(['verify' => true]);

// ホームページ
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Aboutページ
Route::get('/about', function () {
    return view('about');
})->name('about');

// 認証後のルート
Route::middleware(['auth'])->group(function () {
    // 管理画面
    

    // カートのルート
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
});

// 商品のルート
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// メール確認ページ
Route::get('/verify', [EmailVerificationController::class, 'show'])->middleware('auth');

// チェックアウトのルート
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/session', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

// コンタクトフォームのルート
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
