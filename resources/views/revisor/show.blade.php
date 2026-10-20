<x-layout>
    <div class="container mt-5">
        <div class="row py-5">
            <div class="col-12">
                <a href="{{ (route('revisor.index')) }}" class="btn btn-outline-light mb-3 show-back-link">
                    &larr; {{ __('ui.back') }}
                </a>
            </div>
            

             <!-- rating imamgini   -->
@foreach ($advertisement->images as $key => $image)
    <div class="col-6">
        <div class="card mb-3 ">
            <div class="row g-0 ">
                <div class="col-md-4">
                    <img src="{{ $image->getUrl(600, 600) }}"
                        class="img-fluid rounded-start" alt="Immagine {{ $key + 1 }} dell'articolo '{{ $advertisement->title }}'"
                    >
                </div>
                <div class="col-md-5 ps-3 ">
                    <div class="card-body">
                        <h5 class="">Labels</h5>
                        @if ($image->labels)
                            @foreach ($image->labels as $label)
                                #{{ $label }},
                            @endforeach
                        @else
                            <p class="fst-italic">No labels</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-body ">
                        <h5 class="">Ratings</h5>
                        <div class="row justify-content-center">
                            <div class="col-2">
                                <div class="text-center mx-auto {{ $image->adult }}">
                                </div>
                            </div>
                            <div class="col-10">adult</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-2">
                                <div class=" text-center mx-auto {{ $image->violence }}">
                                </div>
                            </div>
                            <div class="col-10">violence</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-2">
                                <div class=" text-center mx-auto {{ $image->spoof }}">
                                </div>
                            </div>
                            <div class="col-10">spoof</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-2">
                                <div class=" text-center mx-auto {{ $image->racy }}">
                                </div>
                            </div>
                            <div class="col-10">racy</div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-2">
                                <div class=" text-center mx-auto {{ $image->medical }}">
                                </div>
                            </div>
                            <div class="col-10">medical</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


                        
                  




           <!-- <div class="col-12 col-md-6 d-flex justify-content-center mt-5">
                <div class="car-01__viewer" data-image-viewer>
                    @forelse ($advertisement->images as $image)
                        <input
                            type="radio"
                            name="advertisement-{{ $advertisement->id }}-image"
                            id="advertisement-{{ $advertisement->id }}-image-{{ $loop->iteration }}"
                            class="car-01__radio"
                            data-image-index="{{ $loop->index }}"
                            @checked($loop->first)
                        >
                    @empty
                        <p>{{ __('ui.noImageAvailable') }}</p>
                    @endforelse

                    @if ($advertisement->images->isNotEmpty())
                        <div class="car-01__stage">
                            @foreach ($advertisement->images as $image)
                                <img
                                    class="car-01__main {{ $loop->first ? 'is-active' : '' }}"
                                    data-image-index="{{ $loop->index }}"
                                    src="{{ $image->getUrl(600, 600) }}"
                                    alt="{{ __('ui.listingImageNumberAlt', ['number' => $loop->iteration, 'title' => $advertisement->title]) }}"
                                >
                            @endforeach
                        </div>

                        <div class="car-01__thumbs" role="presentation">
                            @foreach ($advertisement->images as $image)
                                <label
                                    class="car-01__thumb"
                                    for="advertisement-{{ $advertisement->id }}-image-{{ $loop->iteration }}"
                                >
                                    <img
                                        src="{{ $image->getUrl(600, 600) }}"
                                        width="160"
                                        height="160"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div> -->
                {{-- @foreach ($advertisement->images as $key => $image )
                    <div class="carousel-item @if($loop->first) active @endif">
                        <img src="{{ $image->getUrl(300, 300) }}" class="d-block w-100 rounded shadow"
                            alt="Immagine  {{ $key + 1 }} dell'articolo {{ $advertisement->title }}">
                    </div>
                    
                @endforeach

                {{-- <div id="advertisementCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">
                        @forelse ($advertisement->images as $image)
                            <div class="carousel-item @if ($loop->first) active @endif">
                                <img
                                    src="{{ $image->getUrl(600, 600) }}"
                                    class="d-block w-100 rounded shadow"
                                    alt="Immagine {{ $loop->iteration }} dell'articolo {{ $advertisement->title }}"
                                >
                            </div>
                        @empty
                            <p class="text-light">Nessuna immagine disponibile.</p>
                        @endforelse
                    </div> --}}
            <div class="col-12 col-md-6 mt-5">
                <div class="color-p">
                    <h1 class="color-a">{{ $advertisement->title }}</h1>
                    <p class="card-text">{{ $advertisement->description }}</p>
                    <p class="card-text"><span class="color-a">{{ __('ui.price') }}:</span>{{ ' ' . $advertisement->price }} €</p>
                    <p class="card-text"> <span
                            class="color-a">{{ __('ui.category') }}:</span>{{ ' ' . __('ui.' . $advertisement->category->name) }}</p>
                    {{-- <button type="submit" class="btn bg-s" data-bs-theme="dark">
                        Acquista
                    </button> --}}
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success text-center shadow rounded small d-inline-block py-2 px-3 mb-2" role="status">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="d-flex gap-2 mt-3">
                    @if ($advertisement->is_accepted === null)
                        <form method="POST" action="{{ route('reject', $advertisement) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn revisor-action-button revisor-action-button--reject">
                                {{ __('ui.reject') }}
                            </button>
                        </form>
                        <form method="POST" action="{{ route('accept', $advertisement) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn revisor-action-button revisor-action-button--accept">
                                {{ __('ui.approve') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('revision', $advertisement) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn revisor-action-button revisor-action-button--pending">
                                {{ __('ui.sendBackToReview') }}
                            </button>
                        </form>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-layout>
