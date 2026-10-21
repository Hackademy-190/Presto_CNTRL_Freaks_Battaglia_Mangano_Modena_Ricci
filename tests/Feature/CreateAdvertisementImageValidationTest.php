<?php

use App\Livewire\CreateAdvertisementForm;
use Livewire\Livewire;

test('an advertisement cannot be created without at least one image', function () {
    Livewire::test(CreateAdvertisementForm::class)
        ->set('title', 'Test article')
        ->set('description', 'A description long enough')
        ->set('price', '10')
        ->set('category', '1')
        ->set('language', 'it')
        ->call('store')
        ->assertHasErrors(['images' => 'required']);

    $this->assertDatabaseCount('advertisements', 0);
});
