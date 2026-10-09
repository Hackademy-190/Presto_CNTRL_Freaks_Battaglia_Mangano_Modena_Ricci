<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
  public function create (){
    return view ('advertisement.create');
  }
  public function index ()
  {
    $advertisements = Advertisement::orderBy('created_at', 'desc')->get();
    return view  ('advertisement.index', compact('advertisements'));
  }
}
