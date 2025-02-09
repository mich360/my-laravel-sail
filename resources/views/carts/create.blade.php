@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">カート</h1>

    {{-- スタイルの追加 --}}
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

        button {
            background-color:rgb(37, 76, 155);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
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

    {{-- 商品追加フォーム --}}
    <form action="{{ route('cart.store') }}" method="POST" class="mb-8 flex items-center space-x-4">
        @csrf
        <div>
            <label for="item_id" class="block text-sm font-medium">商品</label>
            <select name="item_id" id="item_id" required class="p-2 border rounded">
                <option value="">選択してください</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} (¥{{ number_format($item->price) }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="quantity" class="block text-sm font-medium">数量</label>
            <input type="number" name="quantity" id="quantity" min="1" value="1" required class="p-2 border rounded w-20">
        </div>

        <button type="submit">追加</button>
    </form>

    {{-- カート内容 --}}
    @if ($cartItems->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>小計</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ optional($item->item)->name ?? '商品なし' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>¥{{ number_format(optional($item->item)->price * $item->quantity ?? 0) }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500">削除</button>
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
@endsection
