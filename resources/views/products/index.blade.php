@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>製品一覧</h1>

        <div class="row">
            @foreach($items as $item)
                <div class="col-md-4">
                    <div class="card">
                        <!-- 画像の表示 -->
                        <img src="{{ asset('images/' . $item->image_path) }}" alt="{{ $item->name }}" width="230">

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text">¥{{ number_format($item->price) }}</p>
                            
                            <!-- カートに追加するフォーム -->
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <input type="hidden" name="quantity" value="1"> <!-- 数量を1に設定 -->
                                <button type="submit" class="btn btn-primary">カートに追加</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
