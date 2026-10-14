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
    // Logiche revisione annunci

    public function index()
    {
        $advertisements_to_check = Advertisement::where('is_accepted', null)->get();
        $advertisements_already_checked = Advertisement::whereIn('is_accepted', [true, false])->get();
        return view('revisor.index', compact('advertisements_to_check', 'advertisements_already_checked'));


    }

    public function accept(Advertisement $advertisement)
    {
        $advertisement->setAccepted(true);
        return redirect()
            ->back()
            ->with('message', "L'articolo $advertisement->title è stato approvato");
    }

    public function reject(Advertisement $advertisement)
    {
        $advertisement->setAccepted(false);
        return redirect()
            ->back()
            ->with('message', "L'articolo $advertisement->title non è stato approvato");
    }

    public function revision(Advertisement $advertisement)
    {
        $advertisement->setAccepted(null);
        return redirect()
            ->back()
            ->with('message', "L'articolo $advertisement->title è sotto revisione.");
    }

    // Fine logiche revisione annunci


    // Logiche mail-revisor

    public function becomeRevisor()
    {
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->route('welcome')->with('message', 'Complimenti, Hai richiesto di diventare revisore');
    }


    public function makeRevisor(User $user)
    {
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->back();
    }

    // Fine Logiche mail-revisor


}
