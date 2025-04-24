<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // ユーザーがログインしていない場合、ログイン画面にリダイレクト
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // ログインしたユーザーを取得
        $user = Auth::user();

        // is_admin フィールドが1ならば、管理者としてアクセスを許可
        if ($user->is_admin == 1) {
            return $next($request);
        }

        // 管理者でない場合、エラーメッセージと共にトップページにリダイレクト
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
