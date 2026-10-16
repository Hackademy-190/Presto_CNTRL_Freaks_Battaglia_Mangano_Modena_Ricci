<x-layout>
    <div class="container mt-5">
        <div class="row py-5">
            <div class="col-12">
                <a href="{{ (route('revisor.index')) }}" class="btn btn-outline-light mb-3 show-back-link">
                    &larr; Torna indietro
                </a>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center mt-5">
                {{-- <div class="car-01__viewer">
                    <input type="radio" name="car-01" id="car-01-1" class="car-01__radio" checked>
                    <input type="radio" name="car-01" id="car-01-2" class="car-01__radio">
                    <input type="radio" name="car-01" id="car-01-3" class="car-01__radio">
                    <input type="radio" name="car-01" id="car-01-4" class="car-01__radio">
                    <div class="car-01__stage">
                        <img class="car-01__main" src="https://picsum.photos/seed/sneaker-a/800/800" width="800"
                            height="800" alt="Trail runner, three-quarter view">
                        <img class="car-01__main" src="https://picsum.photos/seed/sneaker-b/800/800" width="800"
                            height="800" alt="Trail runner, sole detail">
                        <img class="car-01__main" src="https://picsum.photos/seed/sneaker-c/800/800" width="800"
                            height="800" alt="Trail runner, heel and laces">
                        <img class="car-01__main" src="https://picsum.photos/seed/sneaker-d/800/800" width="800"
                            height="800" alt="Trail runner, top-down view">
                    </div>
                    <div class="car-01__thumbs" role="presentation">
                        <label class="car-01__thumb" for="car-01-1"><img
                                src="https://picsum.photos/seed/sneaker-a/160/160" width="160" height="160"
                                alt="" aria-hidden="true"></label>
                        <label class="car-01__thumb" for="car-01-2"><img
                                src="https://picsum.photos/seed/sneaker-b/160/160" width="160" height="160"
                                alt="" aria-hidden="true"></label>
                        <label class="car-01__thumb" for="car-01-3"><img
                                src="https://picsum.photos/seed/sneaker-c/160/160" width="160" height="160"
                                alt="" aria-hidden="true"></label>
                        <label class="car-01__thumb" for="car-01-4"><img
                                src="https://picsum.photos/seed/sneaker-d/160/160" width="160" height="160"
                                alt="" aria-hidden="true"></label>
                    </div>
                </div> --}}

                {{-- @foreach ($advertisement->images as $key => $image )
                    <div class="carousel-item @if($loop->first) active @endif">
                        <img src="{{ $image->getUrl(300, 300) }}" class="d-block w-100 rounded shadow"
                            alt="Immagine  {{ $key + 1 }} dell'articolo {{ $advertisement->title }}">
                    </div>
                    
                @endforeach --}}

                <div id="advertisementCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">
                        @forelse ($advertisement->images as $image)
                            <div class="carousel-item @if ($loop->first) active @endif">
                                <img
                                    src="{{ $image->getUrl(300, 300) }}"
                                    class="d-block w-100 rounded shadow"
                                    alt="Immagine {{ $loop->iteration }} dell'articolo {{ $advertisement->title }}"
                                >
                            </div>
                        @empty
                            <p>Nessuna immagine disponibile.</p>
                        @endforelse
                    </div>

                    @if ($advertisement->images->count() > 1)
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#advertisementCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Precedente</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#advertisementCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Successiva</span>
                        </button>
                    @endif
                </div>

            </div>
            <div class="col-12 col-md-6 mt-5">
                <div class="color-p">
                    <h1 class="color-a">{{ $advertisement->title }}</h1>
                    <p class="card-text">{{ $advertisement->description }}</p>
                    <p class="card-text"><span class="color-a">Prezzo:</span>{{ ' ' . $advertisement->price }} €</p>
                    <p class="card-text"> <span
                            class="color-a">Categoria:</span>{{ ' ' . $advertisement->category->name }}</p>
                    {{-- <button type="submit" class="btn bg-s" data-bs-theme="dark">
                        Acquista
                    </button> --}}
                </div>

                <div class="d-flex pb-4 justify-content-around">
                    @if ($advertisement->is_accepted === null)
                        <form action="{{ route('reject', ['advertisement' => $advertisement]) }}" method="POST">
                            @csrf
                            @method('patch')
                            <button class="btn btn-danger py-2 px-5 fw-bold ">Rifiuta</button>
                        </form>
                        <form action="{{ route('accept', ['advertisement' => $advertisement]) }}" method="POST">
                            @csrf
                            @method('patch')
                            <button class="btn btn-success py-2 px-5 fw-bold ">Accetta</button>
                        </form>
                    @else
                        <form action="{{ route('revision', ['advertisement' => $advertisement]) }}" method="POST">
                            @csrf
                            @method('patch')
                            <button class="btn ad-card-action w-100 py-2 fw-bold">Revisiona</button>
                        </form>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-layout>
