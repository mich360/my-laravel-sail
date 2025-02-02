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
        dd($authUser);  // ユーザー情報を確認
        // 管理者チェック（UserモデルにisAdminメソッドが実装されている必要があります）
        if (!$authUser->isAdmin()) {
            abort(403, '管理者専用ページです。');
        }

        // 全ユーザーのリストを取得
        $users = User::all();

        // サンプルデータ
        $data = [
            '総ユーザー数' => User::count(),
            // 'アクティブユーザー数' => User::where('status', 'active')->count(),
            '最新の登録ユーザー' => User::latest()->first()->name,
            // 最も'アクティブなユーザー' => User::withCount('activities')->orderBy('activities_count', 'desc')->first()->name,
            '最新のユーザー登録日' => User::latest()->first()->created_at->toDateString(),
            // '売上高' => Order::sum('total_amount'),
            // '支払い処理された注文数' => Order::where('status', 'completed')->count(),
            // '新規顧客数' => Customer::where('created_at', '>=', now()->startOfMonth())->count(),
        ];
        
        // ビューにデータを渡して表示
        return view('admin.index', compact('authUser', 'users', 'data'));
    }
}
