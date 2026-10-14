<x-layout>


    <div class="snap-container bg-hero">

        <section class="hero-marketplace">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Messaggio Revisor error -->
                    @if (session()->has('errorMessage'))
                        <div class="alert alert-danger text-center shadow rounded w-50">
                            {{ session('errorMessage') }}
                        </div>
                    @endif
                    <!-- Fine Messaggio revisor error -->

                    {{-- snippet email  --}}
                    @if (session()->has('message'))
                        <div class="alert alert-success text-center shadow rounded w-50">
                            {{ session('message') }}
                        </div>
                    @endif
                    {{-- fine snippet email  --}}

                    @error('generico')
                      <div class="alert alert-danger text-center shadow rounded w-50">{{ $message }}</div>
                    @enderror

                    <!-- Testo della Hero -->
                    <div class="col-lg-7 hero-content">
                        <h1 class="hero-title">
                            Ogni oggetto ha una
                        </h1>
                        <h1 class="hero-title span-cust pb-3 px-2"> seconda storia.</h1>

                        <p class="hero-description">
                            Scopri occasioni uniche, acquista in modo
                            più consapevole e dai una nuova vita agli
                            oggetti che meritano di essere ritrovati.
                        </p>

                        <div class="hero-actions">
                            <a href="{{ route('advertisement.index') }}" class="btn btn-hero-primary">
                                Esplora gli oggetti
                                <span aria-hidden="true">&rarr;</span>
                            </a>

                            <a href="{{ route('advertisement.create') }}" class="btn btn-hero-secondary ">
                                Inizia a vendere
                            </a>
                        </div>

                        <p class="hero-caption">
                            Un buon acquisto, una nuova storia.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="snap-section home-advertisements">
            <div class="container">
                <header class="home-advertisements-heading">
                    <h2>Annunci in primo piano</h2>
                    <p>Esplora gli oggetti in cerca di una seconda storia.</p>
                </header>
                <div class="row g-2 justify-content-center">
                    @foreach ($advertisements as $advertisement)
                        <div class="col-6 col-md-4">
                            <div class="card ad-card">
                                <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image"
                                    alt="{{ $advertisement->title }}">
                                <div class="card-body ad-card-body">
                                    <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                                        {{ $advertisement->title }}</h5>
                                    <p class="card-text ad-card-description">
                                        {{ Str::limit($advertisement->description, 100) }}</p>
                                    <div>
                                        <span class="ad-card-price">{{ $advertisement->price }} €</span>
                                        <span class="ad-card-category">{{ $advertisement->category->name }}</span>
                                    </div>
                                    <a class="ad-card-link"
                                        href="{{ route('advertisement.show', $advertisement) }}">Visualizza articolo</a>
                                    {{-- <button type="submit" class="btn btn-sm ad-card-action" data-bs-theme="dark">
                                        Acquista
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-layout>
