 <!-- resources/views/carts/index.blade.php -->
 @extends('layouts.app')

@section('content')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .col-md-4 {
            flex: 1 0 20%;
            max-width: 20%;
            min-width: 200px;
            padding: 10px;
            box-sizing: border-box;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-body {
            flex-grow: 1;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                flex: 1 0 30%;
                max-width: 33.33%;
            }
        }

        @media (min-width: 992px) {
            .col-md-4 {
                flex: 1 0 25%;
                max-width: 25%;
            }
        }

        @media (min-width: 1200px) {
            .col-md-4 {
                flex: 1 0 20%;
                max-width: 20%;
            }
        }

        .mt-3 {
            margin-bottom: 30px;
            margin-right: 56px;
        }
    </style>

    <div class="container">
        <h1>カートの中身</h1>

        @if($carts->count() > 0)
            <div class="mt-3">
                <a href="{{ route('checkout') }}" class="btn btn-primary">購入手続きへ進む</a>
            </div>
        @endif

        <!-- セッションメッセージ -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse($carts as $cart)
                @if(isset($cart->item)) <!-- nullチェックを追加 -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('images/' . ($cart->item->image_path ?? 'default.jpg')) }}" alt="{{ $cart->item->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cart->item->name }}</h5>
                                <p class="card-text">{{ $cart->item->description }}</p>
                                <p class="card-text">¥{{ number_format($cart->item->price) }}</p>
                                <p class="card-text">数量: {{ $cart->quantity }}</p>

                                <!-- 数量更新フォーム -->
                                <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <input type="number" name="quantity" value="{{ old('quantity', $cart->quantity) }}" min="1" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" required>
                                        @error('quantity')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-warning">更新</button>
                                </form>

                                <!-- カートアイテム削除フォーム -->
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> 削除
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <p>このカートアイテムに関連付けられた商品情報が見つかりません。</p>
                @endif
            @empty
                <p>カートは空です。</p>
            @endforelse
        </div>

        @if($carts->count() > 0)
            <div class="mt-3">
                <a href="{{ route('checkout') }}" class="btn btn-primary">購入手続きへ進む</a>
            </div>
        @endif
    </div>
@endsection
