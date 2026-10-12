<x-layout>
    <div class="container mt-5">
        <div class="row py-5">
            <div class="col-6">

                <div id="carouselExample" class="carousel carousel-overlay slide">
                    <div class="carousel-inner rounded-5">
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/200/200" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/200/200" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/200/200" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <div class="carousel-overlay-controls">
                        <div>
                            <button class="btn-icon btn-sm btn-subtle theme-secondary" type="button"
                                data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-icon-prev" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="btn-icon btn-sm btn-subtle theme-secondary" type="button"
                                data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-icon-next" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="col color-p">
                    <h1>{{ $advertisement->title }}</h1>
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
    </div>
</x-layout>
