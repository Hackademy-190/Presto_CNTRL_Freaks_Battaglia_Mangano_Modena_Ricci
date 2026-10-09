<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
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
    #[Validate('required')]
    public $category = '';


    public function store()
    {
        // dd($this->title, $this->description, $this->price, $this->category);
        $this->validate();
        Advertisement::create([

            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'user_id'=> Auth::user()->id,
            'category_id'=>$this->category

        ]);
        $this->resetInputs();
        session()->flash('success', 'Annuncio creato con successo');
    }


    public function resetInputs()
    {

        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category ='';

    }

    public function render()
    {
        return view('livewire.create-advertisement-form');
    }
}
