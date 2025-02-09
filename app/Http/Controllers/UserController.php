<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show($id)
    {
        // ユーザー情報を取得
        $user = User::findOrFail($id);

        // 管理者データ（例）
        $data = [
            '総ユーザー数' => User::count(),
            '最新の登録ユーザー' => User::latest()->first()->name,
            '最新のユーザー登録日' => User::latest()->first()->created_at->toDateString(),
        ];

        // ビューを返す
        return view('user.show', compact('user', 'data'));
    }

    /**
     * パスワード変更処理
     */
    public function updatePassword(Request $request)
    {
        // バリデーション
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        // 現在ログインしているユーザーを取得
        $user = Auth::user();

        // 新しいパスワードをハッシュ化して保存
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'パスワードが更新されました。');
    }
}
