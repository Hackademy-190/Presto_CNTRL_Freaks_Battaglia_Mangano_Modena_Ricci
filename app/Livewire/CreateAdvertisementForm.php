<?php

namespace App\Livewire;

use App\Jobs\ResizeImage;
use App\Models\Advertisement;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
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
    public $images = [];
    public $temporary_images;

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

        dispatch(new ResizeImage($newImage->path, 300, 300));
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
    }

    public function render()
    {
        return view('livewire.create-advertisement-form');
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate(
            [
                'temporary_images.*' => 'image|max:1024',
                'temporary_images' => 'max:6'
            ]
        )) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }
    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }
}
