{{-- resources/views/settings.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold text-gray-800">アカウント設定</h1>
    <p class="mt-2 text-gray-600">ここでアカウント情報を更新できます。</p>

    <form method="POST" action="{{ route('settings.update') }}" class="mt-6">
        @csrf
        {{-- ユーザー名 --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">ユーザー名</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>

        {{-- メールアドレス --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                class="w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
        </div>

        {{-- 更新ボタン --}}
        <button type="submit"
    class="px-4 py-2 bg-blue-500 text-white font-medium rounded-md shadow hover:bg-blue-600">
            <span style="color:rgb(11, 105, 139);">更新する</span>
         </button>
    </form>
    @if (session('status'))
    <div class="mb-4 text-green-600">
        {{ session('status') }}
    </div>
@endif

</div>
@endsection
