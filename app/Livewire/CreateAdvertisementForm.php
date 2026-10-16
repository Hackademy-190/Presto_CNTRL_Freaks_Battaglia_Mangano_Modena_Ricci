<?php

namespace App\Livewire;

use App\Jobs\ResizeImage;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAdvertisementForm extends Component
{
    #[Validate('required|min:3')]
    public $title;

    #[Validate('required|min:12')]
    public $description;

    #[Validate('required')]
    public $price;

    #[Validate('required')]
    public $category = '';
    #[Validate([
        'images' => 'required|array|max:4',
        'images.*' => 'image|max:4096',
    ])]
    public $images = [];

    #[Validate([
        'temporary_images' => 'array|max:4',
        'temporary_images.*' => 'image|max:4096',
    ])]
    public $temporary_images = [];

    use WithFileUploads;

    public function store()
    {
        // dd($this->title, $this->description, $this->price, $this->category);
        $this->validate();

        $advertisement = Advertisement::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id(),
        ]);

        // if (count($this->images) > 0) {
        //     foreach ($this->images as $image) {
        //         $this->advertisement->images()->create(['path' => $image->store('images', 'public')]);
        //     }
        // }

        // session()->flash('success', 'Annuncio creato con successo');
        // $this->resetInputs();

        foreach ($this->images as $image) {
            $directory = "advertisement/{$advertisement->id}";
            $newImage = $advertisement->images()->create([
                'path' => $image->store($directory, 'public'),
            ]);

            dispatch(new ResizeImage($newImage->path, 600, 600));
        }

        if ($this->images !== []) {
            File::deleteDirectory(storage_path('app/livewire-tmp'));
        }

        session()->flash('success', 'Articolo creato correttamente');
        $this->resetInputs();
    }

    public function resetInputs()
    {

        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->images = [];
    }

    public function render()
    {
        return view('livewire.create-advertisement-form');
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate(
            [
                'temporary_images.*' => 'image|max:4096',
                'temporary_images' => 'array|max:4',
            ]
        )) {
            if (count($this->images) + count($this->temporary_images) > 4) {
                $this->addError('temporary_images', 'Puoi caricare al massimo 4 immagini.');
                $this->temporary_images = [];

                return;
            }

            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }

            $this->temporary_images = [];
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
            $this->resetErrorBag('temporary_images');
        }
    }
}
