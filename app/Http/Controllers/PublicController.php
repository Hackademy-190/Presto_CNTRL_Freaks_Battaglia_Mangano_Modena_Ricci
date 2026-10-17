<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function welcome()
    {
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

        $query = $request->input('query');
        if (! $query) {
            return back()->withErrors(['generico' => __('ui.emptySearch')]);
        }

        $searchField = $request->input('field', 'all');

        if ($searchField === 'category') {
            $categoryIds = Category::query()
                ->get(['id', 'name'])
                ->filter(function (Category $category) use ($query): bool {
                    if (Str::contains($category->name, $query, true)) {
                        return true;
                    }

                    foreach (['it', 'en', 'es'] as $locale) {
                        $translationKey = 'ui.'.$category->name;

                        if (Lang::has($translationKey, $locale)
                            && Str::contains(__($translationKey, [], $locale), $query, true)) {
                            return true;
                        }
                    }

                    return false;
                })
                ->modelKeys();

            $advertisements = Advertisement::query()
                ->where('is_accepted', true)
                ->whereIn('category_id', $categoryIds)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('advertisement.searched', compact('advertisements', 'query', 'searchField'));
        }

        // Se l'utente cerca in un campo specifico, formattiamo la stringa per TNTSearch
        if ($searchField && $searchField !== 'all') {
            // TNTSearch permette di specificare il campo direttamente nella stringa della query sintattica
            // Esempio risultante: "titolo_cercato" (ma filtrato successivamente per precisione)

            // La soluzione più stabile con Scout + TNTSearch per campi specifici senza toccare il DB
            // consiste nel filtrare la collection restituita tramite una callback di ricerca:
            $scoutQuery = Advertisement::search($query, function ($tnt, $searchQuery, $isSearchable) {
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

    public function setLanguage(string $lang): RedirectResponse
    {
        abort_unless(in_array($lang, ['it', 'en', 'es'], true), 404);

        session()->put('locale', $lang);

        return redirect()->back();
    }
}
