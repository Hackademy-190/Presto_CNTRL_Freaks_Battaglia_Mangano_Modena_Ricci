<x-layout>
    <div class="container py-5">
        
        <header class="home-advertisements-heading mt-5">
            <h2 class="pt-5">Articoli in vendita</h2>
            @error('generico')
                <div class="alert alert-danger text-center shadow rounded w-50">{{ $message }}</div>
            @enderror
        </header>
        <div class="row align-items-stretch pb-4 g-4">
            <div class="col-12">
                <x-category-nav />
                {{-- @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                @endforeach --}}

            </div>
            @foreach ($advertisements as $advertisement)
                <div class="col-12 col-md-4">
                    <div class="card ad-card">
                        <!-- ad-card-image rimosso dopo il crop delle immagini, check fe -->
                        <img src="{{ $advertisement->images->isNotEmpty() ? $advertisement->images->first()->getUrl(600, 600) : 'https://picsum.photos/200' }}"
                                class="card-img-top" alt="Immagine dell'annuncio {{ $advertisement->title }}">
                        <div class="card-body ad-card-body">
                            <h5 class="card-title ubuntu-medium text-uppercase ad-card-title text-truncate d-block">
                                {{ $advertisement->title }}
                            </h5>
                            <p class="card-text ad-card-description">{{ Str::limit($advertisement->description, 100) }}
                            </p>
                            <p class="card-text ad-card-price">{{ $advertisement->price }} €</p>
                            <p class="card-text ad-card-category">{{ $advertisement->category->name }}</p>
                            <p class="ad-card-link"><a
                                    href="{{ route('advertisement.show', $advertisement) }}">Visualizza
                                    articolo</a></p>
                            {{-- <button type="button" class="btn ad-card-action" data-bs-theme="dark">
                                Acquista
                            </button> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <div class="index-pagination my-5">
            {{ $advertisements->links('pagination.index') }}
        </div>
    </div>
</x-layout>
