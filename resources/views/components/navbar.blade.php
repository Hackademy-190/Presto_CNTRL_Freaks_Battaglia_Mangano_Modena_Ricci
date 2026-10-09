<nav class="navbar navbar-expand-lg navbar-cus p-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand ubuntu-medium-italic fs-2" href="#">Presto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('advertisement.create') }}">Aggiungi articolo</a>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('advertisement.index') }}">Articoli</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @auth
                            Ciao {{ auth()->user()->name }}!
                        @else
                            Login/Registrati
                        @endauth
                    </a>
                    <ul class="dropdown-menu mt-3">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrati</a></li>
                        @else
                            <li><a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">Logout</a>
                                <form action="{{ route('logout') }}" method= "POST" id="form-logout" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
