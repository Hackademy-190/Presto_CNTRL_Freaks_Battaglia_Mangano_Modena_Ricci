<x-layout>

    <div class="container py-5">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-12 col-md-8 col-lg-6">

                <div class="card shadow border-0">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">

                            <h1 class="fw-bold">
                                Accedi
                            </h1>

                            <p class="text-muted">
                                Inserisci le tue credenziali per accedere al tuo account.
                            </p>

                        </div>


                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul class="mb-0">

                                    @foreach ($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form method="POST" action="{{ route('login') }}">

                            @csrf


                            <div class="mb-3">

                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input type="email" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Inserisci la tua email" autofocus
                                    autocomplete="email">

                            </div>


                            <div class="mb-3">

                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <input type="password" id="password" name="password"
                                    placeholder="Inserisci la tua password" autocomplete="current-password">

                            </div>

                            <div class="d-grid">

                                <button type="submit" class="btn bg-s" data-bs-theme="dark">
                                    Accedi
                                </button>

                            </div>

                        </form>


                        <div class="text-center mt-4">

                            <span class="text-muted">
                                Non hai ancora un account?
                            </span>

                            <a href="{{ route('register') }}" class="text-decoration-none">
                                Registrati
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-layout>
