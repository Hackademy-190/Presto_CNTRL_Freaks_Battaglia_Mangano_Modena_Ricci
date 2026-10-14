<nav class="navbar navbar-expand-lg navbar-cus p-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand ubuntu-medium-italic fs-2" href="{{ route('welcome') }}">Presto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" aria-current="page"
                        href="{{ route('welcome') }}">Home</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('advertisement.create') ? 'active' : '' }}"
                        href="{{ route('advertisement.create') }}">Aggiungi articolo</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('advertisement.index') ? 'active' : '' }}"
                        href="{{ route('advertisement.index') }}">Articoli</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorie
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                        <li><a class="dropdown-item text-capitalize"
                                href="{{ route('categories.show', ['category' => $category]) }}">{{ $category->name }}</a>
                        </li>
                        @if (!$loop->last)
                        <hr class="dropdown-divider">
                        @endif
                        @endforeach
                    </ul>
                </li>
                <!-- Accesso revisor reviews -->
                @auth
                @if (auth()->user()->is_revisor)
                <li class="nav-item">
                    <a class="nav-link btn position-relative" href="{{ route('revisor.index') }}">Dashboard revisore
                        @livewire('revisor-counter')
                    </a>
                </li>
                @endif
                @endauth
                <!-- Fine accesso revisor reviews -->

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
                            <form action="{{ route('logout') }}" method="POST" id="form-logout" class="d-none">
                                @csrf
                            </form>
                        </li>
                        @endguest
                    </ul>
                </li>

                <li class="nav-item">
                    <form class="search-form d-flex align-items-center gap-2 ms-auto" role="search"
                        action="{{ route('advertisement.search') }}" method="GET">
                        <div class="group">
                            <button class="search-submit" type="submit" aria-label="Cerca">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
                                    <path
                                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                    </path>
                                </svg>
                            </button>

                            <input id="query" class="input mt-0" type="search" placeholder="Cerca un annuncio..."
                                name="query" value="{{ request('query') }}" aria-label="Cerca un annuncio" />
                            <button class="search-clear" type="button" aria-label="Cancella ricerca" hidden>
                                &times;
                            </button>
                        </div>
                        <div class="dropdown search-filter">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle search-filter-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Filtri
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end mt-3">
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchAll" value="all"
                                            {{ request('field', 'all') === 'all' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchAll">Tutto</label>
                                    </div>


                                </li>
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchTitle" value="title"
                                            {{ request('field') === 'title' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchTitle">Solo Titolo</label>
                                    </div>


                                </li>
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchCategory" value="category"
                                            {{ request('field') === 'category' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchCategory">Solo Categoria</label>
                                    </div>


                                </li>
                                <li class="dropdown-item">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="field"
                                            id="searchDescription" value="description"
                                            {{ request('field') === 'description' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="searchDescription">Solo Corpo
                                            (Descrizione)</label>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </form>
                </li>
                {{-- barra ricerca con radio button  --}}

            </ul>

        </div>
    </div>
</nav>