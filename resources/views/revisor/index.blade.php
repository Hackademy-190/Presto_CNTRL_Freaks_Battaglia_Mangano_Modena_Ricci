<x-layout>
    <div class="container-fluid mt-5">
        <h1 class="revisor-dashboard-label mt-5">{{ __('ui.reviewerDashboard') }}</h1>
        <section class="snap-section home-advertisements py-5">
            <div class="container">
                <header class="home-advertisements-heading revisor-review-heading mt-5">
                    <h2 class="revisor-review-title">
                        <svg class="revisor-review-gears" viewBox="0 0 100 80" aria-hidden="true">
                            <g transform="translate(100 0) scale(-1 1)">
                                <path fill-rule="evenodd" d="M29.68 28.65 30.31 23.41 39.69 23.41 40.32 28.65 46.33 31.14 50.49 27.88 57.12 34.51 53.86 38.67 56.35 44.68 61.59 45.31 61.59 54.69 56.35 55.32 53.86 61.33 57.12 65.49 50.49 72.12 46.33 68.86 40.32 71.35 39.69 76.59 30.31 76.59 29.68 71.35 23.67 68.86 19.51 72.12 12.88 65.49 16.14 61.33 13.65 55.32 8.41 54.69 8.41 45.31 13.65 44.68 16.14 38.67 12.88 34.51 19.51 27.88 23.67 31.14Z M24 50a11 11 0 1 0 22 0 11 11 0 1 0-22 0Z" />
                                <path fill-rule="evenodd" d="M68.25 5.96 68.70 2.29 75.30 2.29 75.75 5.96 79.98 7.71 82.90 5.44 87.56 10.10 85.29 13.02 87.04 17.25 90.71 17.70 90.71 24.30 87.04 24.75 85.29 28.98 87.56 31.90 82.90 36.56 79.98 34.29 75.75 36.04 75.30 39.71 68.70 39.71 68.25 36.04 64.02 34.29 61.10 36.56 56.44 31.90 58.71 28.98 56.96 24.75 53.29 24.30 53.29 17.70 56.96 17.25 58.71 13.02 56.44 10.10 61.10 5.44 64.02 7.71Z M64.5 21a7.5 7.5 0 1 0 15 0 7.5 7.5 0 1 0-15 0Z" />
                            </g>
                        </svg>
                        {{ __('ui.reviewListings') }}
                    </h2>
                </header>
                @if ($advertisements_to_check->isNotEmpty())
                    <div id="pendingReviewCarousel" class="carousel slide pending-review-carousel py-4">
                        <div class="carousel-inner">
                            @foreach ($advertisements_to_check->chunk(3) as $advertisement_group)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row justify-content-center align-items-stretch g-4">
                                        @foreach ($advertisement_group as $advertisement_to_check)
                                            <div class="col-12 col-md-4">
                                                <div class="card ad-card">
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
                                                                {{ Str::limit($advertisement_to_check->description, 50) }}
                                                            </p>
                                                            <p class="card-text ad-card-price">
                                                                {{ $advertisement_to_check->price }} €
                                                            </p>
                                                        </a>
                                                        <p class="card-text ad-card-category">{{ __('ui.' . $advertisement_to_check->category->name) }}</p>
                                                        <p class="ad-card-link">{{ __('ui.pendingReview') }}</p>
                                                        <div class="d-flex w-100 gap-2 mt-auto pt-3">
                                                            <button class="btn w-100 py-2">
                                                                <a href="{{ route('revisor.show', ['advertisement' => $advertisement_to_check]) }}" class="text-decoration-none text-light w-100 d-block">{{ __('ui.goToReview') }}</a>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#pendingReviewCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">{{ __('pagination.previous') }}</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#pendingReviewCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">{{ __('pagination.next') }}</span>
                        </button>
                    </div>
                @else
                    <div class="rounded shadow bg-body-secondary p-3">
                        <h2 class="h4 text-center mb-0">{{ __('ui.noListingsToReview') }}</h2>
                    </div>
                @endif
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