{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold text-gray-800">ダッシュボード</h1>
    <p class="mt-2 text-gray-600">ようこそ、{{ Auth::user()->name }}さん！</p>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        {{-- カード例: プロフィール --}}
        <div class="p-4 bg-blue-100 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-blue-800">プロフィール</h2>
            <p class="mt-2 text-blue-700">メール: {{ Auth::user()->email }}</p>
        </div>

        {{-- カード例: 設定 --}}
        <div class="p-4 bg-green-100 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-green-800">アカウント設定</h2>
            <p class="mt-2 text-green-700">パスワードや詳細を更新するには、設定をご利用ください。</p>
            <a href="{{ url('/settings') }}" class="text-green-600 hover:underline">設定へ進む</a>
        </div>

        {{-- カード例: ログアウト --}}
        <div class="p-4 bg-red-100 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-red-800">セッション</h2>
            <p class="mt-2 text-red-700">現在ログイン中</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:underline">ログアウト</button>
            </form>
        </div>
    </div>
</div>
@endsection
