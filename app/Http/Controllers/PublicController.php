<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome() 
    {
        $advertisements = Advertisement::where('is_accepted', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
            
        return view('welcome', compact('advertisements'));
    }

    public function searchAdvertisements(Request $request)
    {
        $query = $request->input('query');
        $searchField = $request->input('field', 'all'); // Il valore dei tuoi radio button

        // 1. Inizia la ricerca con TNTSearch/Scout
        if ($query) {
            $scoutQuery = Advertisement::search($query);
        } else {
            // Se la query è vuota, partiamo da una query Eloquent standard
            $scoutQuery = Advertisement::query();
        }

        // 2. Filtra sempre per annunci accettati
        $scoutQuery->where('is_accepted', true);

        // 3. Gestisci il filtro dei radio button se è diverso da 'all'
        // (Modifica 'category_id' o la logica in base a come funzionano i tuoi radio button)
        if ($searchField && $searchField !== 'all') {
            // Se i radio button rappresentano ad esempio delle categorie specifiche:
            $scoutQuery->where('category_id', $searchField);
        }

        // 4. Pagina i risultati
        $advertisements = $scoutQuery->paginate(10);

        return view('advertisement.searched', compact('advertisements', 'query', 'searchField'));
    }
}