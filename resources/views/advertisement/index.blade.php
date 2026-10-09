<x-layout>
    @foreach ( $advertisements as $advertisement )
    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $advertisement->title }}</h5>
                <p class="card-text">{{ $advertisement->description }}</p>
                <p class="card-text">{{ $advertisement->price }}</p>
                <p class="card-text">{{ $advertisement->category->name }}</p>
            </div>
    </div>
     @endforeach
</x-layout>