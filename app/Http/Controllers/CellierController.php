<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Cellier;
use App\Models\Bouteille;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CellierController extends Controller
{
    /**
     * Affiche la liste des celliers de l'utilisateur.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupère les celliers avec le nombre de bouteilles et les informations des bouteilles
        $celliers = Cellier::withCount('bouteillesCelliers')
            ->with('bouteillesCelliers.bouteille')
            ->where('user_id', Auth::id())
            ->get();

        // Calcule le prix total pour chaque cellier
        $celliers->each(function ($cellier) {
            $cellier->prixTotal = 0;
            foreach ($cellier->bouteillesCelliers as $bouteilleCellier) {
                $cellier->prixTotal += $bouteilleCellier->bouteille->prix;
            }
        });

        return view('cellier.index', ['celliers' => $celliers]);
    }

    public function afficherFormulaireRecherche(Request $request)
{
    $cellierId = $request->input('cellier_id');
    
    // Si l'ID du cellier est passé, récupérez les données du cellier
    $cellier = null;
    if ($cellierId) {
        $cellier = DB::table('celliers')->find($cellierId);
    }
    

    return view('cellier.show-search', ['cellier' => $cellier]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cellier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['nom' => 'required|max:255'],
            [
                'nom.required' => 'Le nom du cellier est obligatoire.',
                'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.'
            ]
        );

        $newCellier = Cellier::create([
            'nom' => $request->nom,
            'user_id' => Auth::id()
        ]);

        $newCellier->save();

        return redirect(route('cellier.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function show(Cellier $cellier_id, Request $request)
    {
        $cellier = $cellier_id;

        $sort = $request->input('sort');

        if ($sort == 'name-asc') {
            $cellier->bouteillesCelliers = $cellier->bouteillesCelliers->sortBy('bouteille.nom');
        } elseif ($sort == 'name-desc') {
            $cellier->bouteillesCelliers = $cellier->bouteillesCelliers->sortByDesc('bouteille.nom');
        } elseif ($sort == 'price-asc') {
            $cellier->bouteillesCelliers = $cellier->bouteillesCelliers->sortBy('bouteille.prix');
        } elseif ($sort == 'price-desc') {
            $cellier->bouteillesCelliers = $cellier->bouteillesCelliers->sortByDesc('bouteille.prix');
        }

        return view('cellier.show', ['cellier' => $cellier]);
    }

    
    public function edit($cellier_id)
    {
        $cellier = Cellier::findOrFail($cellier_id);

        return view('cellier.edit', ['cellier' => $cellier]);
    }

    
    public function update(Request $request, $cellier_id)
    {
        $request->validate(
            ['nom' => 'required|max:255'],
            [
                'nom.required' => 'Le nom du cellier est obligatoire.',
                'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.'
            ]
        );

        Cellier::findOrFail($cellier_id)->update([
            'nom' => $request->nom
        ]);

        return redirect(route('cellier.index'));
    }

    
    public function destroy($cellier_id)
    {
        try {
            $cellier = Cellier::findOrFail($cellier_id);
            $cellier->bouteillesCelliers()->delete();
            $cellier->delete();
            return redirect(route('cellier.index'));
        } catch (\Exception $e) {
            return redirect(route('cellier.index'))->with('error', 'Le cellier n\'existe pas');
        }
    }

    public function showSearchForm()
    {
        $cellier = Cellier::where('user_id', Auth::id())->first();

        
        $resultatsTri = Bouteille::orderBy('nom')->get();

        
        $cellierId = $cellier->id;

        
        return view('cellier.show-search', compact('cellier', 'resultatsTri', 'cellierId'));
    }

    
public function recherche(Request $request)
{
    $user_id = Auth::id();

    $nomBouteille = $request->input('nom_bouteille');
    $typeVin = $request->input('type_vin');
    $regionVin = $request->input('region_vin');
    $anneeVin = $request->input('annee_vin');

    $celliers = Cellier::with(['bouteillesCelliers.bouteille'])
        ->where('user_id', $user_id)
        ->get();

    $resultats = collect();

    foreach ($celliers as $c) {
        foreach ($c->bouteillesCelliers as $bouteilleCellier) {
            $bouteille = $bouteilleCellier->bouteille;

            
            if (
                (!$nomBouteille || stripos($bouteille->nom, $nomBouteille) !== false) &&
                (!$typeVin || $bouteille->type == $typeVin) &&
                (!$regionVin || $bouteille->region == $regionVin) &&
                (!$anneeVin || $bouteille->annee == $anneeVin)
            ) {
                $resultats->push(['bouteille' => $bouteille, 'cellier' => $c]);
            }
        }
    }

    
    return view('cellier.show-search', ['resultats' => $resultats, 'cellier' => null, 'cellierId' => null]);
}

public function triBouteilles($cellier_id, $critere)
{
    
    $cellier = Cellier::findOrFail($cellier_id);
    $bouteilles = $cellier->bouteilles()->orderBy($critere)->get();

    return view('cellier.show', compact('cellier', 'bouteilles'));
}

}
