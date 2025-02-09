<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ProductController,
    CartController,
    CheckoutController,
    ContactController,
    EmailVerificationController,
    HomeController,
    SettingsController,
    UserController,
    AdminController
};

// 認証ルート（メール確認を有効化）
Auth::routes(['verify' => true]);

// ホームページと基本ページ
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

// 設定関連
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', function () { return view('settings'); })->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/settings/password', [UserController::class, 'updatePassword'])->name('settings.updatePassword');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.updatePassword');
});

// ダッシュボード
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ユーザー情報
Route::middleware(['auth'])->get('/user/{id}', function ($id) {
    if (Auth::id() != $id) {
        abort(403, 'Unauthorized action.');
    }
    return (new UserController())->show($id);
})->name('user.show');

// 管理者専用ページ
Route::middleware(['auth', 'is_admin'])->get('/admin', [AdminController::class, 'index'])->name('admin.index');

// カート関連
Route::middleware(['auth'])->group(function () {
    Route::resource('carts', CartController::class);
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/create', [CartController::class, 'create'])->name('cart.create');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

// 商品関連
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// チェックアウト
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::post('/checkout/session', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.session');
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

// メール認証
Route::get('/verify', [EmailVerificationController::class, 'show'])->middleware('auth');

// コンタクトフォーム
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
