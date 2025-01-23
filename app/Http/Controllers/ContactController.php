<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    // showCreateFormメソッドをGETリクエストに対応させる
    public function showCreateForm()
    {
        return view('cart.create');  // cart.createビューを返す
    }

    // createメソッドはPOSTリクエストを処理
    public function create(Request $request)
    {
        // カートの作成処理など
    }

    // app/Http/Controllers/ContactController.php
    public function showForm()
    {
        return view('contact');  // contact.blade.phpを返す
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // メール送信やデータベース保存などの処理をここで行います。

        return redirect()->route('contact.form')->with('success', 'お問い合わせが送信されました！');
    }
}
