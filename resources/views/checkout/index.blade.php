<!-- resources/views/checkout/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>購入手続き</h1>
        
        <p>合計金額: ¥{{ number_format($totalAmount) }}</p>
        
        <!-- Stripe Checkoutボタン -->
        <form action="{{ route('checkout.session') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary" id="checkout-button">購入手続きへ進む</button>
        </form>

        <!-- Stripeの公開鍵を含むscript -->
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ $stripeKey }}');
            document.getElementById('checkout-button').addEventListener('click', function(e) {
                e.preventDefault();
                fetch('{{ route('checkout.session') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                    })
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(sessionId) {
                    return stripe.redirectToCheckout({ sessionId: sessionId });
                })
                .then(function(result) {
                    if (result.error) {
                        alert(result.error.message);
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
            });
        </script>
    </div>
@endsection
