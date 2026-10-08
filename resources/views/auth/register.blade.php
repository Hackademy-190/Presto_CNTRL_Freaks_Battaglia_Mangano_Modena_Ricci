<x-layout>
    <h1>Registrati</h1>

    <form action="/register" method="POST">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" placeholder="Inserisci il tuo nome" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Inserisci la tua email" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Crea una password" required>
        </div>

        <div class="form-group">
            <label>Conferma Password</label>
            <input type="password" name="password_confirmation" placeholder="Ripeti la password" required>
        </div>

        <button class="btn-register" type="submit">Registrati</button>

        <div class="extra-links">
            <a href="/login">Hai già un account?</a>
        </div>
    </form>
</x-layout>
