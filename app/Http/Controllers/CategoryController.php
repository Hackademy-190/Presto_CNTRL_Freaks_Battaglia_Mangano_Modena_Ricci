<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $advertisements = $category->advertisements()
            ->where('is_accepted', true)
            ->where('language', app()->getLocale())
            ->orderBy('created_at', 'desc')
            ->get();
        $categories = Category::all();

        return view('categories.show', compact('category', 'advertisements', 'categories'));
    }
}
