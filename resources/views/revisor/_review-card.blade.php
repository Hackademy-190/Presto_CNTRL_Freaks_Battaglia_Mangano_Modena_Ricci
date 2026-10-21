<div class="container py-2">
    <div class="row g-4 justify-content-center align-items-start">
        <!-- Immagini e Rating Revisore -->
        <div class="col-12 col-lg-7">
            <div class="row g-3">
                @forelse ($advertisement->images as $key => $image)
                    <div class="col-12">
                        <div class="card bg-dark text-light border-secondary shadow-sm">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4">
                                    <img src="{{ $image->getUrl(600, 600) }}" class="img-fluid rounded-start w-100" style="object-fit: cover; height: 160px;"
                                        alt="Immagine {{ $key + 1 }} dell'articolo '{{ $advertisement->title }}'">
                                </div>
                                <div class="col-md-5 ps-3">
                                    <div class="card-body py-2 px-2">
                                        <h6 class="text-warning mb-1 fs-6">Labels</h6>
                                        @if ($image->labels)
                                            <small class="text-muted d-block" style="max-height: 100px; overflow-y: auto;">
                                                @foreach ($image->labels as $label)
                                                    #{{ $label }}
                                                @endforeach
                                            </small>
                                        @else
                                            <p class="fst-italic small mb-0 text-muted">No labels</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card-body py-2 px-2 small">
                                        <h6 class="text-warning mb-1 fs-6">Ratings</h6>
                                        <div class="row align-items-center g-1 mb-1">
                                            <div class="col-2"><div class="mx-auto {{ $image->adult }}"></div></div>
                                            <div class="col-10 text-muted">adult</div>
                                        </div>
                                        <div class="row align-items-center g-1 mb-1">
                                            <div class="col-2"><div class="mx-auto {{ $image->violence }}"></div></div>
                                            <div class="col-10 text-muted">violence</div>
                                        </div>
                                        <div class="row align-items-center g-1 mb-1">
                                            <div class="col-2"><div class="mx-auto {{ $image->spoof }}"></div></div>
                                            <div class="col-10 text-muted">spoof</div>
                                        </div>
                                        <div class="row align-items-center g-1 mb-1">
                                            <div class="col-2"><div class="mx-auto {{ $image->racy }}"></div></div>
                                            <div class="col-10 text-muted">racy</div>
                                        </div>
                                        <div class="row align-items-center g-1">
                                            <div class="col-2"><div class="mx-auto {{ $image->medical }}"></div></div>
                                            <div class="col-10 text-muted">medical</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-3">
                        <p>{{ __('ui.noImageAvailable') }}</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Dettagli Annuncio e Azioni Revisore -->
        <div class="col-12 col-lg-5 color-p">
            <div class="p-4 bg-dark rounded border border-secondary shadow h-100 d-flex flex-column">
                <h2 class="color-a mb-3 fs-3">{{ $advertisement->title }}</h2>
                <p class="card-text text-light flex-grow-1 mb-3" style="max-height: 180px; overflow-y: auto; white-space: pre-line;">{{ $advertisement->description }}</p>
                <p class="card-text mb-2"><span class="color-a fw-bold">{{ __('ui.price') }}:</span> {{ $advertisement->price }} €</p>
                <p class="card-text mb-4"><span class="color-a fw-bold">{{ __('ui.category') }}:</span> {{ __('ui.' . $advertisement->category->name) }}</p>

                <div class="d-flex gap-2 mt-auto pt-3 border-top border-secondary">
                    <button type="button" wire:click="reject({{ $advertisement->id }})"
                        wire:loading.attr="disabled"
                        wire:target="reject({{ $advertisement->id }})"
                        class="btn btn-danger flex-fill py-2 fw-semibold">
                        {{ __('ui.reject') }}
                    </button>
                    <button type="button" wire:click="approve({{ $advertisement->id }})"
                        wire:loading.attr="disabled"
                        wire:target="approve({{ $advertisement->id }})"
                        class="btn btn-success flex-fill py-2 fw-semibold">
                        {{ __('ui.approve') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
