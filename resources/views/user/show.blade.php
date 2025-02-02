<!DOCTYPE html>
<!-- /Users/user1/Desktop/my-laravel-sail/resources/views/user/show.blade.php -->
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報</title>
</head>
<body>
    <h1>{{ $user->name }}さんの情報</h1>
    <p>Email: {{ $user->email }}</p>
    <p>役割: {{ $user->role }}</p>
    <p>管理者: {{ $user->isAdmin() ? 'はい' : 'いいえ' }}</p>
    <p>作成日: {{ $user->created_at }}</p>

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
    @endif
</body>
</html>
