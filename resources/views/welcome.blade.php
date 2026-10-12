<x-layout>
    <div class="container-fluid bg-hero vh-100"></div>
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
                            <p><a class="" href="">Visualizza articolo</a></p>
                            <button type="submit" class="btn bg-s" data-bs-theme="dark">
                                Acquista
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('advertisement.create') }}" class="btn bg-s" data-bs-theme="dark">
                Crea annuncio
            </a>
        </div>
    </div>
</x-layout>
