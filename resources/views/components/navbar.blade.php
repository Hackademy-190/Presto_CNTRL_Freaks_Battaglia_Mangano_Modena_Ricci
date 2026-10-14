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
                    <a class="nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('advertisement.create') ? 'active' : '' }}" href="{{ route('advertisement.create') }}">Aggiungi articolo</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('advertisement.index') ? 'active' : '' }}" href="{{ route('advertisement.index') }}">Articoli</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorie
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                        <li><a class="dropdown-item text-capitalize"
                                href="{{ route('categories.show', ['category'=> $category]) }}">{{ $category->name }}</a>
                        </li>
                        @if (!$loop->last)
                        <hr class="dropdown-divider">
                        @endif
                        @endforeach
                    </ul>
                </li>
                <!-- Accesso revisor reviews -->
                @auth
                @if(auth()->user()->is_revisor)
                <li class="nav-item">
                    <a class="nav-link btn btn position-relative" href="{{route('revisor.index')}}">Dashboard revisore
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
                {{-- <form class="d-flex ms-auto" role="search" action="{{ route('advertisement.search') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="query" class="form-control" placeholder="Search" aria-label="search">
                    <button type="submit" class="input-group-text btn btn-outline-success" id="basic-addon2">
                        Search
                    </button>
                </div>
                </form> --}}


                {{-- barra ricerca con radio button  --}}
                <form class="d-flex flex-column ms-auto" role="search" action="{{ route('advertisement.search') }}" method="GET">

                    <!-- Campo di ricerca principale -->
                    <div class="input-group">
                        <input type="search" name="query" class="form-control" placeholder="Cerca un annuncio..." aria-label="search" value="{{ request('query') }}">
                        <button type="submit" class="input-group-text btn btn-outline-success">
                            Cerca
                        </button>
                    </div>

                    <!-- Opzioni di scelta (Radio Button) posizionate sotto -->
                    <div class="d-flex justify-content-start gap-3 mt-2 text-white small">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="field" id="searchAll" value="all" {{ request('field', 'all') === 'all' ? 'checked' : '' }}>
                            <label class="form-check-label" for="searchAll">Tutto</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="field" id="searchTitle" value="title" {{ request('field') === 'title' ? 'checked' : '' }}>
                            <label class="form-check-label" for="searchTitle">Solo Titolo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="field" id="searchCategory" value="category" {{ request('field') === 'category' ? 'checked' : '' }}>
                            <label class="form-check-label" for="searchCategory">Solo Categoria</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="field" id="searchDescription" value="description" {{ request('field') === 'description' ? 'checked' : '' }}>
                            <label class="form-check-label" for="searchDescription">Solo Corpo (Descrizione)</label>
                        </div>
                    </div>
                </form>

            </ul>
        </div>
    </div>
</nav>