<x-layout>
    <div class="container py-5">
        <div class="row align-items-stretch py-4 g-4">
            <div class="col-12">
                @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                @endforeach
              
            </div>
            @foreach ($advertisements as $advertisement)
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
    <div class="d-flex justify-content-center mt-5">
        <div class="mt-5">
               {{$advertisements->links()}}
        </div>
    </div>

</x-layout>
