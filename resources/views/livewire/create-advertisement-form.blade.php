<div>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit="store" class="">

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>

            <input id="title" type="text" wire:model.live="title">

            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>

            <textarea id="description" wire:model.live="description"></textarea>

            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>

            <input type="number" wire:model="price" min="0" step="0.01" class="form-control">

            @error('price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{-- Categories --}}
        <div class="mb-3">
            <select id="category" wire:model="category" class="form-control">
                <option value="" disabled selected>Seleziona una categoria</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        
        
        <!-- {{-- inserimento immagini --}} -->
        <div class="mb-3">
            <input type="file" wire:model.live="temporary_images" multiple
            class="form-control shadow @error('temporary_images.*') is-invalid @enderror" placeholder="/public/media/images.jpg" />
            @error('temporary_images.*')
            <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
            @error('temporary_images')
            <p class="fst-italic text-danger">{{ $message }}</p>
            @enderror
        </div>
        @if (!empty($images))
        <div class="row">
            <div class="col-12">
                <p>Photo preview:</p>
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
            Crea annuncio
        </button>
    </div>
</form>

</div>