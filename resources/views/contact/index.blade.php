<!-- resources/views/contact/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>お問い合わせ一覧</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>メッセージ</th>
                    <th>作成日時</th>
                    @if (Auth::user() && Auth::user()->is_admin)
                        <th>操作</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at }}</td>
                        @if (Auth::user() && Auth::user()->is_admin)
                            <td>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
