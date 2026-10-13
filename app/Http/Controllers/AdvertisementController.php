<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class AdvertisementController extends Controller implements HasMiddleware
{
  public static function middleware(): array
  {
      return [
          new Middleware('auth', except:['index','show']),
      ];
  }
  public function create (){
    return view ('advertisement.create');
  }
  public function index ()
  {
    $advertisements = Advertisement::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(6);
    return view  ('advertisement.index', compact('advertisements'));
  }

  public function show (Advertisement $advertisement)
  {
    return view ('advertisement.show', compact('advertisement'));
  }

}
