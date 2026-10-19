<x-layout>
    <div class="container mt-5">
        <div class="row py-5">
            <div class="col-12">
                <a href="{{ (route('revisor.index')) }}" class="btn btn-outline-light mb-3 show-back-link">
                    &larr; {{ __('ui.back') }}
                </a>
            </div>
           <div class="col-12 col-md-6 d-flex justify-content-center mt-5">
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
            </div>
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

                <livewire:revisor-advertisement-actions :advertisement="$advertisement" />

            </div>

        </div>
    </div>
</x-layout>
