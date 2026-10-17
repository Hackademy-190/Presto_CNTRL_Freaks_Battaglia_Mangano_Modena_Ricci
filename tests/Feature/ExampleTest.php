<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('visitors can switch interface language', function (string $locale, string $expectedHeadline) {
    $this->post(route('setLocale', ['lang' => $locale]))
        ->assertRedirect()
        ->assertSessionHas('locale', $locale);

    expect(__('ui.everyItem', [], $locale))->toBe($expectedHeadline);
})->with([
    ['en', 'Every item has a'],
    ['es', 'Cada objeto tiene una'],
]);

test('visitors cannot select an unsupported language', function () {
    $this->post(route('setLocale', ['lang' => 'fr']))
        ->assertNotFound();
});

test('validation messages use the active language', function (string $locale, string $expectedMessage) {
    app()->setLocale($locale);

    $validator = Validator::make(
        ['title' => 'ab'],
        ['title' => 'required|min:3'],
    );

    expect($validator->errors()->first('title'))->toBe($expectedMessage);
})->with([
    ['en', 'The title field must be at least 3 characters.'],
    ['es', 'El campo título debe tener al menos 3 caracteres.'],
]);

test('advertisement validation messages are in Italian', function (array $data, array $rules, string $expectedMessage) {
    app()->setLocale('it');

    $validator = Validator::make($data, $rules);

    expect($validator->errors()->first())->toBe($expectedMessage);
})->with([
    'required title' => [
        ['title' => ''],
        ['title' => 'required'],
        'Il campo titolo è obbligatorio.',
    ],
    'minimum title length' => [
        ['title' => 'ab'],
        ['title' => 'min:3'],
        'Il campo titolo deve contenere almeno 3 caratteri.',
    ],
    'image upload type' => [
        ['images' => ['not-an-image']],
        ['images.*' => 'image'],
        'Il campo immagine deve essere un\'immagine.',
    ],
]);

test('failed image uploads show the localized size message', function (string $locale, string $expectedMessage) {
    app()->setLocale($locale);
    $uploadedFile = UploadedFile::fake()->image('photo.jpg');
    $failedUpload = new UploadedFile(
        $uploadedFile->getPathname(),
        'photo.jpg',
        'image/jpeg',
        UPLOAD_ERR_INI_SIZE,
        true,
    );

    $validator = Validator::make(
        ['temporary_images' => [$failedUpload]],
        ['temporary_images.*' => 'image|max:20480'],
    );

    expect($validator->errors()->first('temporary_images.0'))
        ->toBe($expectedMessage);
})->with([
    ['it', 'Il file supera i 4096 KB.'],
    ['en', 'The file exceeds 4096 KB.'],
    ['es', 'El archivo supera los 4096 KB.'],
]);

test('Livewire temporary uploads allow up to 20 MB', function () {
    expect(config('livewire.temporary_file_upload.rules'))
        ->toBe(['required', 'file', 'max:20480']);
});

test('advertisement images may be up to 20 MB but not larger', function () {
    app()->setLocale('it');

    $withinLimit = UploadedFile::fake()->image('within-limit.jpg')->size(20480);
    $overLimit = UploadedFile::fake()->image('over-limit.jpg')->size(20481);
    $validator = Validator::make(
        ['images' => [$withinLimit, $overLimit]],
        ['images.*' => 'image|max:20480'],
    );

    expect($validator->errors()->first('images.1'))
        ->toBe('Il file immagine non può superare 20480 KB.');
});

test('category names are translation keys in every locale', function (string $locale, string $expectedName) {
    expect(__('ui.Elettronica', [], $locale))->toBe($expectedName);
})->with([
    ['en', 'Electronics'],
    ['es', 'Electrónica'],
]);
