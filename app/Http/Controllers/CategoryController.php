<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $advertisements = $category->advertisements->where('is_accepted', true);
        return view('categories.show', compact('category','advertisements'));
    }
}
