<x-layout>
    <h1>login</h1>

    <form action="{{ route('login') }}" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Inserisci la tua email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Inserisci la password">
        </div>

        <button class="btn-login" type="submit">Login</button>
    </form>
</x-layout>
