<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController; // 追加

class CartController extends BaseController // 変更: ControllerをBaseControllerとして継承
{
    // コンストラクタで認証をミドルウェアとして適用
    public function __construct()
    {
        $this->middleware('auth');
    }

    // カートの一覧を表示
    public function index()
    {
        // カートとそのアイテム情報を取得
        $carts = Cart::with('item')->where('user_id', auth()->id())->get(); // ユーザーのカートのみ取得
        return view('carts.index', compact('carts'));
    }

    // カートに商品を追加するためのページ
    public function create()
    {
        // 商品リストを取得
        $items = Item::all();
        return view('carts.create', compact('items'));
    }

    // カートに商品を追加
    public function store(Request $request)
    {
        // 入力バリデーション
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ], [
            'item_id.required' => '商品を選択してください。',
            'item_id.exists' => '選択した商品は存在しません。',
            'quantity.required' => '数量を入力してください。',
            'quantity.integer' => '数量は整数でなければなりません。',
            'quantity.min' => '数量は1以上でなければなりません。',
        ]);

        // カートに商品を追加
        Cart::create([
            'user_id' => auth()->id(),
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
        ]);

        // リダイレクトして成功メッセージを表示
        return redirect()->route('cart.index')->with('success', '商品がカートに追加されました！');
    }

    // カートのアイテム数量を更新
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id); // アイテムが見つからない場合は404エラー

        // 入力バリデーション
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.required' => '数量を入力してください。',
            'quantity.integer' => '数量は整数でなければなりません。',
            'quantity.min' => '数量は1以上でなければなりません。',
        ]);

        // アイテムの数量を更新
        $cart->update([
            'quantity' => $validated['quantity'],
        ]);

        // リダイレクトして成功メッセージを表示
        return redirect()->route('cart.index')->with('success', 'カートが更新されました！');
    }

    // カートからアイテムを削除
    public function destroy($id)
    {
        $cart = Cart::find($id);

        // カートアイテムが存在しない場合
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'カートアイテムが見つかりませんでした。');
        }

        // アイテムを削除
        $cart->delete();

        // リダイレクトして成功メッセージを表示
        return redirect()->route('cart.index')->with('success', '商品がカートから削除されました！');
    }
}
