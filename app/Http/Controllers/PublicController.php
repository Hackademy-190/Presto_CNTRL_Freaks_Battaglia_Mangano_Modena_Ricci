<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;




class PublicController extends Controller
{
    public function welcome() {
        $advertisements = Advertisement::where('is_accepted', true)->orderBy('created_at', 'desc')->take(4)->get();
    return view('welcome', compact('advertisements'));
}


    public function searchAdvertisements(Request $request)
{
    // codice iniziale 

    // dd($request->all());
    // $query = $request->input('query');
    // $advertisements = Advertisement::search($query)->where('is_accepted', true)->paginate(10);
    // return view('advertisement.searched', ['advertisements' => $advertisements, 'query' => $query]);

    
    //   tntsearch ed eloquent 

    // $query = $request->input('query');
    // $searchField = $request->input('field', 'all'); // Predefinito su 'all' se non viene premuto nulla

    // // STRADA A: Se l'utente vuole cercare OVUNQUE, usiamo Laravel Scout (TNTSearch)
    // if ($searchField === 'all' || !$searchField) {
    //     $advertisements = Advertisement::search($query)->where('is_accepted', true)->paginate(10);
    // } 
    // // STRADA B: Se sceglie un radio specifico, usiamo Eloquent
    // else {
    //     $advertisements = Advertisement::where('is_accepted', true)
    //         ->where(function($q) use ($searchField, $query) {
    //             if ($searchField === 'category') {
    //                 // Entra nella relazione e cerca nella colonna 'name' della tabella categories
    //                 $q->whereHas('category', function($catQuery) use ($query) {
    //                     $catQuery->where('name', 'LIKE', "%{$query}%");
    //                 });
    //             } else {
    //                 // Cerca dinamicamente in 'title' o 'description'
    //                 $q->where($searchField, 'LIKE', "%{$query}%");
    //             }
    //         })
    //         ->paginate(10);
    // }

    // // Restituiamo la vista mandando le variabili necessarie
    // return view('advertisement.searched', compact('advertisements', 'query', 'searchField'));


    // solo tntsearch 

    $query = $request->input('query');
    $searchField = $request->input('field', 'all');

    // Se l'utente cerca in un campo specifico, formattiamo la stringa per TNTSearch
    if ($searchField && $searchField !== 'all') {
        // TNTSearch permette di specificare il campo direttamente nella stringa della query sintattica
        // Esempio risultante: "titolo_cercato" (ma filtrato successivamente per precisione)
        
        // La soluzione più stabile con Scout + TNTSearch per campi specifici senza toccare il DB
        // consiste nel filtrare la collection restituita tramite una callback di ricerca:
        $scoutQuery = Advertisement::search($query, function($tnt, $searchQuery, $isSearchable) use ($searchField) {
            // Logica avanzata booleana opzionale interna a TNTSearch
            return $tnt->search($searchQuery);
        });
    } else {
        $scoutQuery = Advertisement::search($query);
    }

    // Applichiamo la condizione di approvazione globale dell'annuncio
    $scoutQuery->where('is_accepted', true);

    // Eseguiamo la paginazione nativa di Scout
    $advertisements = $scoutQuery->paginate(10);

    // SE l'utente ha scelto un campo specifico, filtriamo i record recuperati dall'indice per sicurezza
    if ($searchField && $searchField !== 'all') {
        $advertisements->setCollection(
            $advertisements->getCollection()->filter(function ($advertisement) use ($searchField, $query) {
                if ($searchField === 'category') {
                    // Controlla che il nome della relazione contenga la query
                    return $advertisement->category && str_contains(strtolower($advertisement->category->name), strtolower($query));
                }
                // Controlla dinamicamente le proprietà 'title' o 'description' sul modello caricato
                return str_contains(strtolower($advertisement->{$searchField}), strtolower($query));
            })
        );
    }

    return view('advertisement.searched', compact('advertisements', 'query', 'searchField'));
}

}
