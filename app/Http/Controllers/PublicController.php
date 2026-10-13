<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;



class PublicController extends Controller
{
    public function welcome() {
        $advertisements = Advertisement::where('is_accepted', true)->orderBy('created_at', 'desc')->take(4)->get();
    return view('welcome', compact('advertisements'));
}
}
