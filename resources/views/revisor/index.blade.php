<x-layout>
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-3">
                <div class="rounded shadow bg-body-secondary">
                    <h1 class="display-5 text-center pb-2">
                        Revisor dashboard
                    </h1>
                </div>
            </div>
        </div>
        <section class="snap-section home-advertisements">
            <div class="container">
                <header class="home-advertisements-heading">
                    <h2>Annunci da revisionare</h2>
                </header>
                <div class="row g-2 justify-content-center">
                    @forelse ($advertisements_to_check as $advertisement_to_check)
                    <div class="col-6 col-md-4">
                        <div class="card ad-card">
                            <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image"
                                alt="{{ $advertisement_to_check->title }}">
                            <div class="card-body ad-card-body">
                                <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                                    {{ $advertisement_to_check->title }}
                                </h5>
                                <p class="card-text ad-card-description">{{ $advertisement_to_check->description }}</p>
                                <div>
                                    <span class="ad-card-price">{{ $advertisement_to_check->price }} €</span>
                                    <span class="ad-card-category">{{ $advertisement_to_check->category->name }}</span>
                                </div>
                                <a class="ad-card-link"
                                    href="{{ route('revisor.show', ['advertisement'=>$advertisement_to_check]) }}">Visualizza articolo</a>
                                <div class="d-flex pb-4 justify-content-around">
                                    <form action="{{route('reject',['advertisement'=>$advertisement_to_check])}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-danger py-2 px-5 fw-bold ">Rifiuta</button>
                                    </form>
                                    <form action="{{route('accept',['advertisement'=>$advertisement_to_check])}}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button class="btn btn-success py-2 px-5 fw-bold ">Accetta</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="container-fluid pt-5">
                    <div class="row">
                        <div class="col-3">
                            <div class="rounded shadow bg-body-secondary">
                                <h1 class="display-5 text-center pb-2">
                                    Nessun annuncio da revisionare
                                </h1>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
        @forelse ($advertisements_already_checked as $advertisement_already_checked)
        <div class="col-6 col-md-4">
            <div class="card ad-card">
                <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image"
                    alt="{{ $advertisement_already_checked->title }}">
                <div class="card-body ad-card-body">
                    <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                        {{ $advertisement_already_checked->title }}
                    </h5>
                    <p class="card-text ad-card-description">{{ $advertisement_already_checked->description }}</p>
                    <div>
                        <span class="ad-card-price">{{ $advertisement_already_checked->price }} €</span>
                        <span class="ad-card-category">{{ $advertisement_already_checked->category->name }}</span>
                    </div>
                    <a class="ad-card-link"
                        href="{{ route('revisor.show', ['advertisement'=>$advertisement_already_checked]) }}">Visualizza articolo</a>
                    <div class="d-flex pb-4 justify-content-around">
                        <form action="{{route('revision',['advertisement'=>$advertisement_already_checked])}}" method="POST">
                            @csrf
                            @method('patch')
                            <button class="btn btn-success py-2 px-5 fw-bold ">Revisiona</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-3">
                <div class="rounded shadow bg-body-secondary">
                    <h1 class="display-5 text-center pb-2">
                        Nessun annuncio da revisionare
                    </h1>
                </div>
            </div>
        </div>
        @endforelse
        <!-- Logiche del revisor -->


        <!-- Fine logiche del revisor -->
    </div>

    @if(session()->has('message'))
    <div class="row justify-content-center">
        <div class="col-5 alert-success text-center shadow rounded">
            {{session('message')}}
        </div>
    </div>
    @endif
</x-layout>