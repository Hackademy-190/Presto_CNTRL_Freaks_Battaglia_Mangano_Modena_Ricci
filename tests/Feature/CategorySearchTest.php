<?php

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;

uses(RefreshDatabase::class);

test('category search finds listings using category names in every language', function (string $locale, string $query) {
    $category = Category::create(['name' => 'Elettronica']);

    Advertisement::forceCreate([
        'title' => 'Fotocamera vintage',
        'description' => 'Una fotocamera analogica in ottime condizioni.',
        'price' => 45,
        'category_id' => $category->id,
        'is_accepted' => true,
    ]);

    View::share('categories', Category::query()->get());

    $this->withSession(['locale' => $locale])
        ->get(route('advertisement.search', ['query' => $query, 'field' => 'category']))
        ->assertOk()
        ->assertSee('Fotocamera vintage');
})->with([
    ['it', 'Elettronica'],
    ['en', 'Electronics'],
    ['es', 'Electrónica'],
]);

test('search index includes category names in every language', function () {
    $category = new Category(['name' => 'Elettronica']);
    $advertisement = new Advertisement;
    $advertisement->setRelation('category', $category);

    expect($advertisement->toSearchableArray()['category'])
        ->toContain('Elettronica')
        ->toContain('Electronics')
        ->toContain('Electrónica');
});
