{{-- resources/views/settings.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 p-6 bg-white rounded-lg shadow-md max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">アカウント設定</h1>
    <p class="text-gray-600">ここでアカウント情報を更新できます。</p>

    {{-- アカウント情報更新フォーム --}}
    <form method="POST" action="{{ route('settings.update') }}" class="mt-6 space-y-4">
        @csrf
        {{-- ユーザー名 --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50" required>
        </div>

        {{-- メールアドレス --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50" required>
        </div>

        {{-- 更新ボタン --}}
        <button type="submit" class="w-full">
            更新する
        </button>
    </form>

    {{-- パスワード変更フォーム --}}
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-2">パスワード変更</h2>
        <p class="text-gray-600 mb-4">新しいパスワードを設定できます。</p>

        <form method="POST" action="{{ route('settings.updatePassword') }}" class="space-y-4">
            @csrf
            {{-- 現在のパスワード --}}
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">現在のパスワード</label>
                <input type="password" id="current_password" name="current_password"
                    class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50" required>
            </div>

            {{-- 新しいパスワード --}}
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700">新しいパスワード</label>
                <input type="password" id="new_password" name="new_password"
                    class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50" required>
            </div>

            {{-- 新しいパスワード（確認） --}}
            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">新しいパスワード（確認）</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                    class="w-full px-4 py-2 mt-1 rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-300 focus:ring-opacity-50" required>
            </div>

            {{-- パスワード更新ボタン --}}
            <button type="submit" class="w-full">
                パスワードを変更
            </button>
        </form>
    </div>

    {{-- ステータスメッセージ --}}
    @if (session('status'))
        <div class="mt-4 text-center text-green-600 font-medium">
            {{ session('status') }}
        </div>
    @endif
</div>

{{-- ボタン用のCSS --}}
<style>
    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
        width: 100%;
    }

    button:hover {
        background-color: #45a049;
        transform: scale(1.05);
    }

    button:disabled {
        background-color: #d3d3d3;
        cursor: not-allowed;
    }
</style>
@endsection
