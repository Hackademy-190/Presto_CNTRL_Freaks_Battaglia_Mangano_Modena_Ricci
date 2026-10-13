<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



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


    public function becomeRevisor(){
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('welcome')->with('message', 'Complimenti, Hai richiesto di diventare revisore');
    }


    public function makeRevisor(User $user){
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }


}
