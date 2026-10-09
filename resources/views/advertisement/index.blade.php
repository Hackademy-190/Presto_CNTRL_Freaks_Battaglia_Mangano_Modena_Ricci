<x-layout>
    <div class="container py-5">
        <div class="row vh-100 align-items-center py-5 g-3">
            @foreach ( $advertisements as $advertisement )
            <div class="col-12 col-md-4">
                <div class="card">
                    <img src="https://picsum.photos/180/100" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title ubuntu-medium text-uppercase">{{ $advertisement->title }}</h5>
                            <p class="card-text">{{ $advertisement->description }}</p>
                            <p class="card-text">{{ $advertisement->price }} €</p>
                            <p class="card-text">{{ $advertisement->category->name }}</p>
                        </div>
                </div>
            </div>
             @endforeach
        </div>
    </div>
</x-layout>