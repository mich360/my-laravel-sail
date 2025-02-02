<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function show($id) // メソッド内で処理を行う
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
}
