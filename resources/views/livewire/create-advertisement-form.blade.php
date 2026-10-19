<div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit="store" class="">

        <div class="mb-3">
            <label for="language" class="form-label">{{ __('ui.advertisementLanguage') }}</label>

            <select id="language" wire:model="language" class="form-control">
                @foreach (['it', 'en', 'es'] as $languageCode)
                    <option value="{{ $languageCode }}">{{ __('ui.languageNames.' . $languageCode) }}</option>
                @endforeach
            </select>

            @error('language')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">{{ __('ui.title') }}</label>

            <input id="title" type="text" wire:model.live="title">

            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('ui.description') }}</label>

            <textarea id="description" wire:model.live="description"></textarea>

            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">{{ __('ui.price') }}</label>

            <input type="number" wire:model="price" min="0" step="0.01" class="form-control">

            @error('price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Categories --}}
        <div class="mb-3">
            <select id="category" wire:model="category" class="form-control">
                <option value="" disabled selected>{{ __('ui.selectCategory') }}</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ __('ui.' . $category->name) }}</option>
                @endforeach
            </select>
            @error('category')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        
        
        <!-- {{-- inserimento immagini --}} -->
        <div class="mb-3">
            <div class="image-upload-control">
                <label for="temporary_images" class="btn bg-s image-upload-label">
                {{ __('ui.selectImages') }}
                </label>
                <span class="image-upload-filename" data-file-name
                    data-empty-label="{{ __('ui.noFileSelected') }}" aria-live="polite" wire:ignore>
                    {{ __('ui.noFileSelected') }}
                </span>
                <input id="temporary_images" type="file" wire:model.live="temporary_images" multiple
                    class="visually-hidden @error('temporary_images.*') is-invalid @enderror @error('images.*') is-invalid @enderror"
                    aria-label="{{ __('ui.selectImages') }}" accept="image/*" />
            </div>
            @error('temporary_images.*')
            <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
            @error('images.*')
            <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
            @error('temporary_images')
            <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
        </div>
        @if (!empty($images))
        <div class="row">
            <div class="col-12">
                <p>{{ __('ui.photoPreview') }}</p>
                <div class="row border border-4 border-success rounded shadow py-4">
                    @foreach ($images as $key => $image)
                    <div class="col d-flex flex-column align-items-center my-3">
                        <div class="img-preview mx-auto shadow rounded"
                        style="background-image: url('{{ $image->temporaryUrl() }}');"></div>
                        
                        <button type="button" class="btn mt-1 btn-danger "
                        wire:click="removeImage({{ $key }})">X</button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- {{-- Fine inserimento immagini --}} -->
    <div class="d-grid">
        <button type="submit" class="btn bg-s" data-bs-theme="dark">
            {{ __('ui.createListing') }}
        </button>
    </div>
</form>

</div>