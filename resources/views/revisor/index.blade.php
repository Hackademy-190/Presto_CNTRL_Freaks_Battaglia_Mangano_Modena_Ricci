<x-layout>
    <div class="container-fluid mt-5">
        <h1 class="revisor-dashboard-label mt-5">{{ __('ui.reviewerDashboard') }}</h1>
        <section class="snap-section home-advertisements py-5">
            <div class="container">
                <header class="home-advertisements-heading mt-5">
                    <h2>{{ __('ui.reviewListings') }}</h2>
                </header>
                <div class="row align-items-stretch py-4 g-4">
                    @forelse ($advertisements_to_check as $advertisement_to_check)
                    <div class="col-12 col-md-4">
                        <div class="card ad-card">
                            <!-- crop img  -->
                            <a href="{{ route('revisor.show', ['advertisement' => $advertisement_to_check]) }}" class="d-block">
                                <img src="{{ $advertisement_to_check->images->isNotEmpty() ? $advertisement_to_check->images->first()->getUrl(600, 600) : 'https://picsum.photos/200' }}"
                                class="card-img-top" alt="{{ __('ui.listingImageAlt', ['title' => $advertisement_to_check->title]) }}">
                            </a>
                            <div class="card-body ad-card-body">
                                <a href="{{ route('revisor.show', ['advertisement' => $advertisement_to_check]) }}" class="text-decoration-none text-reset d-block">
                                    <h5 class="card-title ubuntu-medium text-uppercase ad-card-title text-truncate d-block">
                                        {{ $advertisement_to_check->title }}
                                    </h5>
                                    <p class="card-text ad-card-description">
                                        {{ Str::limit($advertisement_to_check->description, 100) }}
                                    </p>
                                    <p class="card-text ad-card-price">
                                        {{ $advertisement_to_check->price }} €
                                    </p>
                                </a>
                                <p class="card-text ad-card-category">{{ __('ui.' . $advertisement_to_check->category->name) }}</p>
                                <p class="ad-card-link">
                                    {{ __('ui.pendingReview') }}
                                </p>
                                <div class="d-flex w-100 gap-2 mt-auto pt-3">
                                    
                                        <button class="btn w-100 py-2 "><a href="{{ route('revisor.show', ['advertisement' => $advertisement_to_check]) }}" class="text-decoration-none text-light w-100 d-block">{{ __('ui.goToReview') }}</a></button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="rounded shadow bg-body-secondary p-3">
                            <h2 class="h4 text-center mb-0">{{ __('ui.noListingsToReview') }}</h2>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="snap-section home-advertisements my-5">
            <div class="container">
                <header class="home-advertisements-heading">
                    <h2>{{ __('ui.reviewedListings') }}</h2>
                </header>
                <div class="row align-items-stretch py-4 g-4">
                    @forelse ($advertisements_already_checked as $advertisement_already_checked)
                    <div class="col-12 col-md-4">
                        <div class="card ad-card">
                            <a href="{{ route('revisor.show', ['advertisement' => $advertisement_already_checked]) }}" class="d-block">
                                <img src="{{ $advertisement_already_checked->images->isNotEmpty() ? $advertisement_already_checked->images->first()->getUrl(600, 600) : 'https://picsum.photos/200' }}"
                                class="card-img-top" alt="{{ __('ui.listingImageAlt', ['title' => $advertisement_already_checked->title]) }}">
                            </a>
                            <div class="card-body ad-card-body">
                                <a href="{{ route('revisor.show', ['advertisement' => $advertisement_already_checked]) }}" class="text-decoration-none text-reset d-block">
                                    <h5 class="card-title ubuntu-medium text-uppercase ad-card-title text-truncate d-block">
                                        {{ $advertisement_already_checked->title }}
                                    </h5>
                                    <p class="card-text ad-card-description">
                                        {{ Str::limit($advertisement_already_checked->description, 100) }}
                                    </p>
                                    <p class="card-text ad-card-price">
                                        {{ $advertisement_already_checked->price }} €
                                    </p>
                                </a>
                                <p class="card-text ad-card-category">{{ __('ui.' . $advertisement_already_checked->category->name) }}</p>
                                <p class="ad-card-link">
                                    <a href="{{ route('revisor.show', ['advertisement' => $advertisement_already_checked]) }}">{{ __('ui.viewListing') }}</a>
                                </p>
                                <div class="d-flex w-100 mt-auto pt-3">
                                    <form class="w-100" action="{{ route('revision', ['advertisement' => $advertisement_already_checked]) }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <button class="btn w-100 py-2 fw-bold">{{ __('ui.editReview') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="rounded shadow bg-body-secondary p-3">
                            <h2 class="h4 text-center mb-0">{{ __('ui.noReviewedListings') }}</h2>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    @if(session()->has('message'))
    <div class="row justify-content-center">
        <div class="col-5 alert-success text-center shadow rounded">
            {{session('message')}}
        </div>
    </div>
    @endif
</x-layout>