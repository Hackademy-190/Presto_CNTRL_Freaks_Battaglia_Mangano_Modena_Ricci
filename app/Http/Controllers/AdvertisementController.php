<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdvertisementController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function create()
    {
        return view('advertisement.create');
    }

    public function index()
    {
        $advertisements = Advertisement::query()
            ->where('is_accepted', true)
            ->where('language', app()->getLocale())
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        $categories = Category::all();

        return view('advertisement.index', compact('advertisements', 'categories'));
    }

    public function show(Advertisement $advertisement)
    {
        return view('advertisement.show', compact('advertisement'));
    }
}
