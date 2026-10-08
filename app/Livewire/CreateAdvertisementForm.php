<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateAdvertisementForm extends Component
{

    #[Validate('required|min:3')]
    public $title;
    #[Validate('required|min:12')]
    public $description;
    #[Validate('required')]
    public $price;


    public function store()
    {

        $this->validate();
        Advertisement::create([

            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price
        ]);
        $this->resetInputs();
        session()->flash('success', 'Annuncio creato con successo');
    }


    public function resetInputs()
    {

        $this->title = '';
        $this->description = '';
        $this->price = '';

         }



    public function render()
    {
        return view('livewire.create-advertisement-form');
    }
}
