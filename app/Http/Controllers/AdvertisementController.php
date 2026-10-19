<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

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
            ->orderBy('updated_at', 'desc')
            ->paginate(8);
        $categories = Category::all();

        return view('advertisement.index', compact('advertisements', 'categories'));
    }

    public function show(Advertisement $advertisement)
    {
        $user = Auth::user();
        $canViewUnapprovedAdvertisement = $user !== null
            && ($user->is_revisor || $user->id === $advertisement->user_id);

        abort_unless($advertisement->is_accepted === true || $canViewUnapprovedAdvertisement, 404);

        return view('advertisement.show', compact('advertisement'));
    }
}
