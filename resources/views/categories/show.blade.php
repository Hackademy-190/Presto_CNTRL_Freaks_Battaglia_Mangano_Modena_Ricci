<x-layout>
        <div class="container py-5">
            <div class="row py-4">
                <div class="col-12">
                    <x-category-nav />
                </div>
            </div>
            <div class="row justify-content-center align-items-stretch py-4 g-4">
                @foreach ($category->advertisements as $advertisement)
                    <div class="col-12 col-md-4">
                        <div class="card ad-card">
                            <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image" alt="{{ $advertisement->title }}">
                            <div class="card-body ad-card-body">
                                <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">{{ $advertisement->title }}</h5>
                                <p class="card-text ad-card-description">{{ $advertisement->description }}</p>
                                <p class="card-text ad-card-price">{{ $advertisement->price }} €</p>
                                <p class="card-text ad-card-category">{{ $advertisement->category->name }}</p>
                                <p class="ad-card-link"><a href="{{ route('advertisement.show', $advertisement) }}">Visualizza articolo</a></p>
                                <button type="button" class="btn ad-card-action" data-bs-theme="dark">
                                    Acquista
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</x-layout>