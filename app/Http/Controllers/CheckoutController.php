<?php

// app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        // ログインユーザーのカート情報を取得、アイテム情報も事前にロード
        $carts = $user->carts()->with('item')->get();

        // カートが空でないか確認
        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'カートに商品がありません');
        }

        // 合計金額の計算
        $totalAmount = $carts->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });

        // Stripeの公開鍵をビューに渡す
        return view('checkout.index', [
            'totalAmount' => $totalAmount,
            'stripeKey' => env('STRIPE_KEY'),
        ]);
    }

    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // カートの中身を取得、アイテム情報も事前にロード
        $carts = auth()->user()->carts()->with('item')->get();
        $lineItems = [];

        foreach ($carts as $cart) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $cart->item->name,
                    ],
                    'unit_amount' => $cart->item->price * 100,  // 金額はセント単位
                ],
                'quantity' => $cart->quantity,
            ];
        }

        try {
            // Checkoutセッションを作成
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            // エラーハンドリングの改善
            return back()->with('error', '支払いセッションの作成に失敗しました: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
