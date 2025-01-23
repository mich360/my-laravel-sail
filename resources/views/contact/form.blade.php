<!-- resources/views/contact/form.blade.php -->
<form action="{{ route('contact.submit') }}" method="POST">
    @csrf
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">メールアドレス:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">メッセージ:</label>
    <textarea id="message" name="message" required></textarea>

    <button type="submit">送信</button>
</form>
