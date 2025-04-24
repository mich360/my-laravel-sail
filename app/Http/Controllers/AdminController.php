<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        // 認証を必須とする
        $this->middleware('auth');
    }

    public function index()
    {
        // 現在ログインしているユーザーを取得
        $authUser = auth()->user();

        // 管理者チェック（UserモデルにisAdminメソッドが実装されている必要があります）
        if (!$authUser->isAdmin()) {
            abort(403, '管理者専用ページです。');
        }

        // 最新のユーザーを1回だけ取得
        $latestUser = User::latest()->first();

        // 全ユーザーのリストを取得
        $users = User::all();

        // 最新のユーザーが存在する場合のみ情報を取得
        if ($latestUser) {
            $latestUserName = $latestUser->name;
            $latestUserCreatedAt = $latestUser->created_at->toDateString();
        } else {
            $latestUserName = 'なし';
            $latestUserCreatedAt = 'なし';
        }

        // サンプルデータ
        $data = [
            '総ユーザー数' => User::count(),
            '最新の登録ユーザー' => $latestUserName,
            '最新のユーザー登録日' => $latestUserCreatedAt,
        ];
        
        // ビューにデータを渡して表示
        return view('admin.index', compact('authUser', 'users', 'data'));
    }
}
