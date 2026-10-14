<x-layout>
    <div class="container-fluid mt-5">
        <h1 class="revisor-dashboard-label mt-5">Revisor dashboard</h1>
        <section class="snap-section home-advertisements py-5">
            <div class="container">
                <header class="home-advertisements-heading mt-5">
                    <h2>Annunci da revisionare</h2>
                </header>
                <div class="row align-items-stretch py-4 g-4">
                    @forelse ($advertisements_to_check as $advertisement_to_check)
                        <div class="col-12 col-md-4">
                            <div class="card ad-card">
                                <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image"
                                    alt="{{ $advertisement_to_check->title }}">
                                <div class="card-body ad-card-body">
                                    <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                                        {{ $advertisement_to_check->title }}
                                    </h5>
                                    <p class="card-text ad-card-description">
                                        {{ Str::limit($advertisement_to_check->description, 100) }}
                                    </p>
                                    <p class="card-text ad-card-price">{{ $advertisement_to_check->price }} €</p>
                                    <p class="card-text ad-card-category">{{ $advertisement_to_check->category->name }}</p>
                                    <p class="ad-card-link">
                                        <a href="{{ route('revisor.show', ['advertisement' => $advertisement_to_check]) }}">Visualizza articolo</a>
                                    </p>
                                    <div class="d-flex w-100 gap-2 mt-auto pt-3">
                                        <form class="flex-fill" action="{{ route('reject', ['advertisement' => $advertisement_to_check]) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <button class="btn btn-danger w-100 py-2 fw-bold">Rifiuta</button>
                                        </form>
                                        <form class="flex-fill" action="{{ route('accept', ['advertisement' => $advertisement_to_check]) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <button class="btn w-100 py-2 fw-bold">Accetta</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                @empty
                    <div class="col-12">
                        <div class="rounded shadow bg-body-secondary p-3">
                            <h2 class="h4 text-center mb-0">Nessun annuncio da revisionare</h2>
                        </div>
                    </div>
                @endforelse
                </div>
            </div>
        </section>
        <section class="snap-section home-advertisements my-5">
            <div class="container">
                <header class="home-advertisements-heading">
                    <h2>Annunci revisionati</h2>
                </header>
                <div class="row align-items-stretch py-4 g-4">
                    @forelse ($advertisements_already_checked as $advertisement_already_checked)
                        <div class="col-12 col-md-4">
                            <div class="card ad-card">
                                <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image"
                                    alt="{{ $advertisement_already_checked->title }}">
                                <div class="card-body ad-card-body">
                                    <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                                        {{ $advertisement_already_checked->title }}
                                    </h5>
                                    <p class="card-text ad-card-description">
                                        {{ Str::limit($advertisement_already_checked->description, 100) }}
                                    </p>
                                    <p class="card-text ad-card-price">{{ $advertisement_already_checked->price }} €</p>
                                    <p class="card-text ad-card-category">{{ $advertisement_already_checked->category->name }}</p>
                                    <p class="ad-card-link">
                                        <a href="{{ route('revisor.show', ['advertisement' => $advertisement_already_checked]) }}">Visualizza articolo</a>
                                    </p>
                                    <div class="d-flex w-100 mt-auto pt-3">
                                        <form class="w-100" action="{{ route('revision', ['advertisement' => $advertisement_already_checked]) }}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <button class="btn w-100 py-2 fw-bold">Modifica Revisione</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="rounded shadow bg-body-secondary p-3">
                                <h2 class="h4 text-center mb-0">Nessun annuncio revisionato</h2>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    @if(session()->has('message'))
    <div class="row justify-content-center">
        <div class="col-5 alert-success text-center shadow rounded">
            {{session('message')}}
        </div>
    </div>
    @endif
</x-layout>