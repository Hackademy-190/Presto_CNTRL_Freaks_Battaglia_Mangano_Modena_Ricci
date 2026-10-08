<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="store">

        <div>
            <label for="title">Titolo</label>

            <input
                id="title"
                type="text"
                wire:model.live="title"
            >

            @error('title')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description">Descrizione</label>

            <textarea
                id="description"
                wire:model.live="description"
            ></textarea>

            @error('description')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="price">Prezzo</label>

            <input
                id="price"
                type="number"
                step="0.01"
                wire:model.live="price"
            >

            @error('price')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">
            Crea annuncio
        </button>

    </form>
</div>
