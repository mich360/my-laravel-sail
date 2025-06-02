@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('http://localhost/') }}">Laravel</a>
                    <span> * </span>
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @auth
                        <p>{{ __('messages.You are logged in!') }}</p>
                    @else
                        <p>{{ __('Please log in to access this content.') }}</p>
                    @endauth
                </div>

                <div class="card-body">
                    <h1>About Us</h1>
                    <div class="mt-4">
                        
                        
                    <a href="{{ route('about') }}" class="btn btn-primary">About</a>
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">dashboard</a>
                    <a href="http://localhost/home" target="_blank" rel="noopener" class="btn btn-primary">製品一覧</a>
                    <a href="http://localhost/cart/create" target="_blank" rel="noopener" class="btn btn-primary">カート/作成</a>
                    <a href="http://localhost/admin" target="_blank" rel="noopener" class="btn btn-primary">Admin</a>
                        <a href="https://welcomecanape.site/" target="_blank" rel="noopener" class="btn btn-secondary">外部リンク</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
