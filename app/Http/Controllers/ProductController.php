<?php

namespace App\Http\Controllers;

use App\Models\Item; // Item モデルをインポート
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 全ての商品を表示
    public function index()
    {
        $items = Item::all(); // すべての商品を取得
        return view('products.index', compact('items'));
    }

    // 新しい製品の作成フォームを表示
    public function create()
    {
        return view('products.create');
    }

    // 新しい製品を保存
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // 新しい商品を作成
        Item::create($validated);

        // リダイレクト
        return redirect()->route('products.index');
    }

    // 特定の製品を表示
    public function show(Item $item)
    {
        return view('products.show', compact('item'));
    }

    // 特定の製品の編集フォームを表示
    public function edit(Item $item)
    {
        return view('products.edit', compact('item'));
    }

    // 製品を更新
    public function update(Request $request, Item $item)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        // 製品を更新
        $item->update($validated);

        return redirect()->route('products.index');
    }

    // 製品を削除
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('products.index');
    }
}
