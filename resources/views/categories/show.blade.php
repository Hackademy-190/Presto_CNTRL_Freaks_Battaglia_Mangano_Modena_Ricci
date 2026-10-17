<x-layout>
        <div class="container py-5">
            <div class="row py-4">
                <div class="col-12">
                    <a href="{{ (route('advertisement.index')) }}" class="btn btn-outline-light mb-3 show-back-link">
                        &larr; {{ __('ui.back') }}
                    </a>
                    <x-category-nav />
                </div>
            </div>
            <div class="row justify-content-center align-items-stretch py-4 g-4">
                @forelse ($category->advertisements as $advertisement)
                    <div class="col-12 col-md-4">
                        <div class="card ad-card">
                            <a href="{{ route('advertisement.show', $advertisement) }}" class="d-block">
                                <img src="{{ $advertisement->images->isNotEmpty() ? $advertisement->images->first()->getUrl(600, 600) : 'https://picsum.photos/200' }}"
                                class="card-img-top" alt="{{ __('ui.listingImageAlt', ['title' => $advertisement->title]) }}">
                            </a>
                            <div class="card-body ad-card-body">
                                <h5 class="card-title ubuntu-medium text-uppercase ad-card-title text-truncate d-block">
                                    <a href="{{ route('advertisement.show', $advertisement) }}" class="text-decoration-none text-reset">
                                        {{ $advertisement->title }}
                                    </a>
                                </h5>
                                <p class="card-text ad-card-description">
                                    <a href="{{ route('advertisement.show', $advertisement) }}" class="text-decoration-none text-reset">
                                        {{ Str::limit($advertisement->description, 100) }}
                                    </a>
                                </p>
                                <p class="card-text ad-card-price">
                                    <a href="{{ route('advertisement.show', $advertisement) }}" class="text-decoration-none text-reset">
                                        {{ $advertisement->price }} €
                                    </a>
                                </p>
                                <p class="card-text ad-card-category">{{ __('ui.' . $advertisement->category->name) }}</p>
                                <p class="ad-card-link"><a href="{{ route('advertisement.show', $advertisement) }}">{{ __('ui.viewListing') }}</a></p>
                                {{-- <button type="button" class="btn ad-card-action" data-bs-theme="dark">
                                    Acquista
                                </button> --}}
                        </div>
                        </div>
                    </div>
                     @empty
                        <header class="home-advertisements-heading  mt-5">
                            <h3>{{ __('ui.noListingsAvailable') }}</h3>
                        </header>
                @endforelse
            </div>
        </div>
</x-layout>