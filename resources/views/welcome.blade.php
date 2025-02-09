<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ViteでビルドしたCSSファイルを読み込み -->
    @vite('resources/sass/app.scss')
    <style>
        .navbar {
            background-color: #343a40 !important; /* 背景色をダークグレーに */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影を追加 */
            padding: 10px 20px; /* 内側の余白を調整 */
        }
                /* ナビゲーションバーの背景色と影の調整 */
        nav.navbar {
            background-color: #343a40; /* ダークな背景色 */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 軽い影 */
        }

        /* ナビゲーションバー内のリンクの色変更 */
        .navbar-nav .nav-link {
            color: #f8f9fa; /* 明るいリンク色 */
            font-weight: 500; /* 少し太めのフォント */
        }

        /* ホバー時にリンク色変更 */
        .navbar-nav .nav-link:hover {
            color:rgb(32, 203, 255); /* ホバー時に赤色に変更 */
        }

        /* ログインと登録ボタンのスタイル */
        .navbar-nav .nav-item .nav-link {
            font-size: 16px; /* 少し大きく */
            margin-right: 10px; /* 右の余白を少し追加 */
        }

        /* モバイルビューでのメニューアイコン（ハンバーガーメニュー）の調整 */
        .navbar-toggler-icon {
            background-color: #f8f9fa; /* アイコンを明るく */
        }

        /* ナビゲーションバーのドロップダウンメニューのカスタマイズ */
        .dropdown-menu {
            background-color: #343a40; /* ダーク背景 */
            border: none; /* 枠線を削除 */
        }

        /* ドロップダウンメニュー内のアイテムの色 */
        .dropdown-item {
            color: #f8f9fa;
        }

        /* ドロップダウンメニューアイテムのホバー時の色 */
        .dropdown-item:hover {
            background-color:rgb(21, 99, 208);
            color: #fff;
        }
    </style>

</head>
<body>
    <header>
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
    </header>

    <main class="container py-4">
        <div id="app" class="text-center">
            <h1 class="display-4 fw-bold mb-3">Welcome to Laravel!</h1>
            <p class="lead mb-4">ようこそ！Laravel Sail環境で構築したECサイトへこのECサイトは、最新のWeb技術を駆使して作成してみました。<br>エレガントで直感的な操作が可能で、洗練されたユーザーエクスペリエンスを提供します。</br>
            
          
        
    このサイトは、<a href="https://laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Laravel</a>と<a href="https://www.docker.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Docker</a>を使用して構築されています。
    </br>強力な<a href="https://laravel.com/docs/sail" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Laravel Sail</a>環境の利点を活かし、迅速に開発が進められるように設計されています。<br>
    コマンドの実行は<a href="https://laravel.com/docs/11.x/sail#starting-and-stopping-sail">こちらご覧ください</a> <b>シェルエイリアスの設定</b>しました。</br>
    さらに、商品管理やカートシステム、支払い処理など、ECサイトに欠かせない基本機能をシームレスに統合しています。
</p>
<div id="scrollEffect" style="height: 140px; background-color: lightblue;">
 

            <div class="mt-4">
                <h3>サイトの特徴:</h3>
                <ul class="list-unstyled">
                    <li>🔹 Dockerを活用：開発環境はすべてDockerコンテナ内で構築され、環境構築の手間が省けます。</li>
                    <li>🔹 Laravelの強力な機能：認証、セッション管理、Eloquent ORM、API構築など、Laravelの標準機能を最大限に活用しています。</li>
                    <li>🔹 拡張性：シンプルな設計ながら、将来的に機能を追加しやすい構造になっています。</li>
                    <li>🔹 迅速でセキュアな支払い処理</li>
                </ul>
            </div>
            
</div>
<script>
    window.addEventListener('scroll', function() {
        const element = document.getElementById('scrollEffect');
        if (window.scrollY > 100) {
            element.style.backgroundColor = 'lightgreen';
        } else {
            element.style.backgroundColor = 'lightblue';
        }
    });
</script>
        </div>

        <p class="mt-4 text-sm">
            Laravelの強力なファーストパーティツールとライブラリ、例えば
            <a href="https://forge.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Forge</a>, 
            <a href="https://vapor.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Vapor</a>, 
            <a href="https://nova.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Nova</a>, 
            <a href="https://envoyer.io" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Envoyer</a>, 
            and <a href="https://herd.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Herd</a> 
            プロジェクトを次のレベルに引き上げるのに役立ちます。強力なオープンソースライブラリと組み合わせて、 
            <a href="https://laravel.com/docs/billing" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Cashier</a>, 
            <a href="https://laravel.com/docs/dusk" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Dusk</a>, 
            <a href="https://laravel.com/docs/broadcasting" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Echo</a>, 
            <a href="https://laravel.com/docs/horizon" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Horizon</a>, 
            <a href="https://laravel.com/docs/sanctum" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Sanctum</a>, 
            <a href="https://laravel.com/docs/telescope" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Telescope</a>, 
            その他多数。<a href="https://laravel.com/docs/11.x/sail#main-content">このサイトはララベルセイルを利用して作成しました</a>
        </p>
        <p>ぜひ、サイトをご覧いただき、開発フローや機能の実装方法について学んでみてください</p>
        <hr>


          <!-- <button id="alertButton" class="btn btn-primary btn-lg">クリックしてみてください</button> -->

        <!-- <img src="{{ asset('images/ha4.JPG') }}" alt="サンプル画像" id="hoverImage"> -->



        <button id="toggleButton" class="btn btn-secondary">詳細を表示</button>
<div id="hiddenContent" style="display: none;">
    <p>これは詳細な情報です。</p>
    <p> <img src="{{ asset('images/ha4.JPG') }}" alt="サンプル画像" id="hoverImage">
    </p>
    <script>
    const image = document.getElementById('hoverImage');
    image.addEventListener('mouseover', function() {
        image.style.transform = 'scale(1.8)';
    });
    image.addEventListener('mouseout', function() {
        image.style.transform = 'scale(1)';
    });
</script>

</div>
<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
        const content = document.getElementById('hiddenContent');
        if (content.style.display === 'none') {
            content.style.display = 'block';
            this.textContent = '詳細を隠す';
        } else {
            content.style.display = 'none';
            this.textContent = '詳細を表示';
        }
    });
</script>


        

        <input type="text" id="nameInput" placeholder="名前を入力">
<p id="message"></p>
<script>
    document.getElementById('nameInput').addEventListener('input', function() {
        const message = document.getElementById('message');
        if (this.value) {
            message.textContent = `こんにちは、${this.value}さん！`;
        } else {
            message.textContent = '';
        }
    });
</script>
    </main>

  

</body>
</html>
