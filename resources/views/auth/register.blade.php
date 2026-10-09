<x-layout>

    <div class="container py-5">

        <div class="row justify-content-center align-items-center vh-100 mt-5">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow border-0">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <h1 class="ubuntu-bold">Registrati</h1>

                            <p class="text-muted">
                                Crea il tuo account inserendo i dati richiesti.
                            </p>
                        </div>


                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form method="POST" action="{{ route('register') }}">

                            @csrf


                            <div class="mb-3">

                                <label for="name" class="form-label">
                                    Nome
                                </label>

                                <input type="text" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Inserisci il tuo nome" autofocus>

                            </div>


                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input type="email" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Inserisci la tua email">

                            </div>


                            <div class="mb-3">

                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input type="password" id="password" name="password"
                                    placeholder="Inserisci la password" autocomplete="new-password">

                            </div>


                            <div class="mb-4">

                                <label for="password_confirmation" class="form-label">
                                    Conferma password
                                </label>

                                <input type="password" id="password_confirmation"
                                    name="password_confirmation" placeholder="Ripeti la password"
                                    autocomplete="new-password">

                            </div>


                            <div class="d-grid">

                                <button type="submit" class="btn bg-s" data-bs-theme="dark">
                                    Registrati
                                </button>

                            </div>

                        </form>


                        <div class="text-center mt-4">

                            <span class="text-muted">
                                Hai già un account?
                            </span>

                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Accedi
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layout>
