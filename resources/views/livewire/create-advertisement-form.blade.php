<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="store">

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>

            <input id="title" type="text" wire:model.live="title">

            @error('title')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>

            <textarea id="description" wire:model.live="description"></textarea>

            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>

            <input id="price" type="number" step="0.01" wire:model.live="price">

            @error('price')
                <span>{{ $message }}</span>
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
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn bg-s" data-bs-theme="dark">
                Crea annuncio
            </button>
        </div>

    </form>
</div>
