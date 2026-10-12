<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome() {
        $advertisements = Advertisement::take(6)->orderBy('created_at', 'desc')->get();
    return view('welcome', compact('advertisements'));
}
}
