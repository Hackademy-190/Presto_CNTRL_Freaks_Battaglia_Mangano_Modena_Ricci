<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
  public function create (){
    return view ('advertisement.create');
  }
}
