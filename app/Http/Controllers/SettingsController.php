<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * アカウント情報の更新
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('settings')->with('status', 'アカウント情報が更新されました！');
    }

    /**
     * パスワードの変更
     */
    public function updatePassword(Request $request)
    {
        // バリデーション
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        // ユーザー情報取得
        $user = Auth::user();

        // 新しいパスワードをハッシュ化して保存
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'パスワードが更新されました。');
    }
}
