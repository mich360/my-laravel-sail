@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contact Us</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <p>ご質問やご意見がございましたら、以下のフォームからお問い合わせください。</p>
        
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">お名前</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">メッセージ</label>
                <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
@endsection
