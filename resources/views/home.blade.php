@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-5">製品一覧</h1>

    <div class="row">
        @foreach($items as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light rounded">
                    <!-- 画像の表示 -->
                    <img src="{{ asset('images/' . $item->image_path) }}" alt="{{ $item->name }}" class="card-img-top" style="height: 270px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text text-muted">{{ $item->description }}</p>
                        <p class="card-text font-weight-bold">¥{{ number_format($item->price) }}</p>
                        
                        <!-- カートに追加するフォーム -->
                        <form action="{{ route('cart.store') }}" method="POST" class="d-inline-block">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <input type="hidden" name="quantity" value="1"> <!-- 数量を1に設定 -->
                            <button type="submit" class="btn btn-primary btn-block">カートに追加</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
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
@endsection