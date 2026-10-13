<x-layout>
    {{-- <div class="container-fluid bg-hero vh-100">

        <section class="hero-marketplace">
            <div class="container">
                <div class="row align-items-center min-vh-75">

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
                            <a href="{{ route('advertisement.index') }}"
                                class="btn btn-hero-primary">
                                Esplora gli oggetti
                                <span aria-hidden="true">&rarr;</span>
                            </a>

                            <a href="{{ route('advertisement.create') }}"
                                class="btn btn-hero-secondary ">
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

    </div>
    <div class="container py-5">
        <div class="row vh-100 align-items-center py-5 g-3">
            @foreach ($advertisements as $advertisement)
            <div class="col-12 col-md-4">
                <div class="card">
                    <img src="https://picsum.photos/180/100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title ubuntu-medium text-uppercase">{{ $advertisement->title }}</h5>
                        <p class="card-text">{{ $advertisement->description }}</p>
                        <p class="card-text">{{ $advertisement->price }} €</p>
                        <p class="card-text">{{ $advertisement->category->name }}</p>
                        <p><a class="" href="{{ route('advertisement.show', $advertisement) }}">Visualizza articolo</a></p>
                        <button type="submit" class="btn bg-s" data-bs-theme="dark">
                            Acquista
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div> --}}





    <div class="snap-container bg-hero">

        <section class="hero-marketplace snap-section">
            <div class="container">
                <div class="row align-items-center">

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
                            <a href="{{ route('advertisement.index') }}"
                                class="btn btn-hero-primary">
                                Esplora gli oggetti
                                <span aria-hidden="true">&rarr;</span>
                            </a>

                            <a href="{{ route('advertisement.create') }}"
                                class="btn btn-hero-secondary ">
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
                        <div class="card home-ad-card">
                            <img src="https://picsum.photos/180/100" class="card-img-top home-ad-card-image" alt="{{ $advertisement->title }}">
                            <div class="card-body home-ad-card-body">
                                <h5 class="card-title ubuntu-medium text-uppercase">{{ $advertisement->title }}</h5>
                                <p class="card-text home-ad-card-description">{{ $advertisement->description }}</p>
                                <div class="home-ad-card-meta">
                                    <span>{{ $advertisement->price }} €</span>
                                    <span>{{ $advertisement->category->name }}</span>
                                </div>
                                <a class="home-ad-card-link" href="{{ route('advertisement.show', $advertisement) }}">Visualizza articolo</a>
                                <button type="submit" class="btn bg-s btn-sm home-ad-card-action" data-bs-theme="dark">
                                    Acquista
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</x-layout>