<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // ユーザーが管理者かどうかをチェック
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // 管理者でなければリダイレクト
        return redirect('/'); // またはエラーページにリダイレクト
    }
}
