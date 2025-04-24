<!-- resources/views/admin/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- プロフィール -->
        <div class="col-md-6">
            <h3>プロフィール</h3>
            <p><strong>名前:</strong> {{ $authUser->name }}</p>
            <p><strong>メール:</strong> {{ $authUser->email }}</p>
            <p><strong>登録日:</strong> {{ $authUser->created_at->format('Y-m-d') }}</p> <!-- 登録日を表示 -->
        </div>

        <!-- 管理データ -->
        <div class="col-md-6">
            <h3>管理データ</h3>
            <ul class="list-group">
                @foreach($data as $key => $value)
                    <li class="list-group-item"><strong>{{ $key }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- 管理者専用情報 -->
    @if($authUser->isAdmin()) <!-- isAdmin メソッドを使う -->
        <div class="alert alert-success mt-4"> <!-- スタイリングのために余白を追加 -->
            <h3>管理者専用情報</h3>
            <p>このセクションは管理者のみ閲覧可能です。</p>
            <ul>
                <li>特別な設定項目</li>
                <li>詳細なシステム情報</li>
                <li>その他の管理機能</li>
            </ul>
        </div>
    @endif
@endsection
