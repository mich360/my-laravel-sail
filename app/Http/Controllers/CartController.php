<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // カートの一覧を表示
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        return view('carts.index', compact('carts'));
    }
    
    // カートに商品を追加するページ
    public function create()
    {
        $items = Item::all(); 
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->item->price * $item->quantity);

        return view('carts.create', compact('items', 'cartItems', 'totalPrice'));
    }

    // カートに商品を追加
    public function store(Request $request)
    {
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

        Cart::create([
            'user_id' => auth()->id(),
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->route('carts.index')->with('success', '商品がカートに追加されました！');
    }

    // カートのアイテム数量を更新
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ], [
            'quantity.required' => '数量を入力してください。',
            'quantity.integer' => '数量は整数でなければなりません。',
            'quantity.min' => '数量は1以上でなければなりません。',
        ]);

        $cart->update(['quantity' => $validated['quantity']]);
        
        return redirect()->route('carts.index')->with('success', 'カートが更新されました！');
    }

    // カートからアイテムを削除
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();
        
        return redirect()->route('carts.index')->with('success', '商品がカートから削除されました！');
    }
}
