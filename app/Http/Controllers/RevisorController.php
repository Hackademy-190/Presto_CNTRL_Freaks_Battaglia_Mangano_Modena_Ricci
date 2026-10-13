<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;



class RevisorController extends Controller
{
    public function index(){
        $advertisement_to_check = Advertisement::where('is_accepted',null)->first();
        return view('revisor.index', compact('advertisement_to_check'));
    }
    public function accept(Advertisement $advertisement){
        $advertisement->setAccepted(true);
        return redirect()
        ->back()
        ->with('message', "L'articolo $advertisement->title è stato approvato");
    }

    public function reject(Advertisement $advertisement){
        $advertisement->setAccepted(false);
        return redirect()
        ->back()
        ->with('message', "L'articolo $advertisement->title non è stato approvato");
    }
}
