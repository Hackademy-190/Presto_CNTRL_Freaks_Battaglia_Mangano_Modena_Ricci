<x-layout>
    <div class="container-fluid ">
        <div class="row py-5 justify-content-center align-items-center text-center mt-5">
            <div class="col-12">
               <h1 class="display-4 color-p">Risultati per la ricerca "<span class="fst-italic">{{ $query }}</span>"</h1>
            </div>
         </div>
        <div class="row height-custom justify-content-center align-items-center py-5 g-4">
            @forelse ($advertisements as $advertisement)
                <div class="col-12 col-md-3 ">
                    <div class="card ad-card">
                        <img src="https://picsum.photos/180/100" class="card-img-top ad-card-image"
                            alt="{{ $advertisement->title }}">
                        <div class="card-body ad-card-body">
                            <h5 class="card-title ubuntu-medium text-uppercase ad-card-title">
                                {{ $advertisement->title }}</h5>
                            <p class="card-text ad-card-description">{{ Str::limit($advertisement->description, 100) }}</p>
                            <p class="card-text ad-card-price">{{ $advertisement->price }} €</p>
                            <p class="card-text ad-card-category">{{ $advertisement->category->name }}</p>
                            <p class="ad-card-link"><a href="{{ route('advertisement.show', $advertisement) }}">Visualizza articolo</a></p>
                                                        {{-- <button type="button" class="btn ad-card-action" data-bs-theme="dark">
                                                            Acquista
                                                        </button> --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">
                       Nessun articolo corrisponde alla tua ricerca
                    </h3>
                </div>
            @endforelse
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div>
          {{ $advertisements->links() }}
        </div>
    </div>
</x-layout>
