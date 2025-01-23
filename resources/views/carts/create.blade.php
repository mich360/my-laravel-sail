<form action="{{ route('cart.store') }}" method="POST">
    @csrf
    <label for="item_id">商品を選択</label>
    <select name="item_id" id="item_id">
        @foreach($items as $item)
            <option value="{{ $item->id }}">{{ $item->name }} - ¥{{ $item->price }}</option>
        @endforeach
    </select>

    <label for="quantity">数量</label>
    <input type="number" name="quantity" id="quantity" min="1" required>

    <button type="submit">カートに追加</button>
</form>
