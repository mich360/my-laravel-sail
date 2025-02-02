@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">カート</h1>

    {{-- カートに商品を追加するフォーム --}}
    <form action="{{ route('cart.store') }}" method="POST" class="mb-8">
        @csrf
        <div class="mb-4">
            <label for="quantity" class="block text-lg font-medium mb-2">数量</label>
            <input type="number" name="quantity" id="quantity" min="1" required class="w-full p-2 border rounded">
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">カートに追加</button>
    </form>

    {{-- カートの内容を表示 --}}
    @if ($cartItems->count() > 0)
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">商品名</th>
                    <th class="px-4 py-2 border">数量</th>
                    <th class="px-4 py-2 border">小計</th>
                    <th class="px-4 py-2 border">操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td class="px-4 py-2 border">{{ optional($item->item)->name ?? '商品なし' }}</td>
                    <td class="px-4 py-2 border text-center">{{ $item->quantity }}</td>
                    <td class="px-4 py-2 border text-right">
                        ¥{{ number_format(optional($item->item)->price * $item->quantity ?? 0) }}
                    </td>
                    <td class="px-4 py-2 border text-center">
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">削除</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

        </table>

        <div class="mt-6 text-right">
            <strong class="text-lg">合計: ¥{{ number_format($totalPrice) }}</strong>
        </div>

        <div class="mt-4 text-right">
            <a href="{{ route('checkout') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">購入手続きへ進む</a>
        </div>
    @else
        <p class="mt-6 text-gray-500">カートに商品がありません。</p>
    @endif
</div>

{{-- この部分にスタイルを追加 --}}
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f8f8f8;
        font-weight: bold;
    }

    table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .btn {
        padding: 10px 20px;
        background-color: #007BFF;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .form-label {
        font-size: 16px;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .mt-6 {
        margin-top: 1.5rem;
    }

    .mt-4 {
        margin-top: 1rem;
    }

    /* ボタンのスタイル */
button {
    background-color: #4CAF50;  /* 緑色 */
    color: white;                /* 文字色を白に */
    padding: 10px 20px;          /* ボタンに十分なパディングを追加 */
    border: none;                /* ボタンの枠線を削除 */
    border-radius: 5px;          /* 角を丸くする */
    font-size: 16px;             /* 文字サイズ */
    cursor: pointer;            /* カーソルをポインタに変更 */
    transition: background-color 0.3s, transform 0.2s; /* ホバー時のアニメーション */
}

/* ボタンにホバーしたときのスタイル */
button:hover {
    background-color: #45a049;  /* ホバー時の色変更 */
    transform: scale(1.05);      /* 少し拡大してボタンを目立たせる */
}

/* ボタンが無効の場合 */
button:disabled {
    background-color: #d3d3d3;  /* グレーに変更 */
    cursor: not-allowed;        /* 無効時のカーソル */
}

</style>

@endsection
