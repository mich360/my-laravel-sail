<!DOCTYPE html>
<!-- /Users/user1/Desktop/my-laravel-sail/resources/views/user/show.blade.php -->
<html lang="ja">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm container">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
        Home
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('ナビゲーション切り替え') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">ホーム</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">概要</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">お問い合わせ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/products') }}">商品一覧</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/cart') }}">カート</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a></li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a></li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<main class="container py-4">
    <h1>{{ $user->name }}さんの情報</h1>
    <p>Email: {{ $user->email }}</p>
    <p>役割: {{ $user->role }}</p>
    <p>管理者: {{ $user->isAdmin() ? 'はい' : 'いいえ' }}</p>
    <p>作成日: {{ $user->created_at }}</p>
<section class="bg-light p-5 border rounded shadow">  
    {{-- 管理者専用情報の表示 --}}
    @if ($user->isAdmin())
        <h2>管理者情報</h2>
        <p>このアカウントは管理者です。</p>
        <p>管理者特権: あなたは全ユーザーの管理ができます。</p>
        
        <!-- 管理データの表示 -->
    
    <div class="col-md-6">
        <h3>管理データ</h3>
        <ul class="list-group">
            @foreach($data as $key => $value)
                <li class="list-group-item"><strong>{{ $key }}:</strong> {{ $value }}</li>
            @endforeach
        </ul>
    </div>
</section>
    @endif
</main>
</body>
</html>
