<?php

namespace App\Http\Controllers;

use App\Models\BouteilleCellier;
use App\Models\Cellier; 
use Illuminate\Http\Request;

class BouteilleCellierController extends Controller
{
    public function index(Request $request)
    {
        $cellierId = $request->input('cellier_id');
        $critereTri = $request->input('tri', 'created_at'); 
        //------------------------------------
    
        
        $cellier = Cellier::find($cellierId);
    
        $bouteilles = BouteilleCellier::triParCritere($critereTri)
            ->where('cellier_id', $cellierId)
            ->get();
    
        return view('cellier.index', compact('bouteilles', 'cellier', 'cellierId'));
    }
    
    public function create()
    {
        // --------------------------
    }

    public function store(Request $request)
    {
        BouteilleCellier::updateOrCreate(
            ['cellier_id' => $request->location_id, 'bouteille_id' => $request->bouteille_id],
            ['quantite' => $request->quantite]
        );

        return response()->json(['message' => 'Mise à jour réussie'], 200);
    }

    public function show(BouteilleCellier $bouteilleCellier)
    {
        
    }

    public function edit(BouteilleCellier $bouteilleCellier)
    {
        
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            ['quantite' => 'required|min:0|integer'],
            [
                'quantite.required' => 'La quantité est obligatoire.',
                'quantite.min' => 'La quantité doit être supérieure ou égale à zéro.',
                'quantite.integer' => 'La quantité doit être entière, sans décimal.'
            ]
        );

        BouteilleCellier::findOrFail($id)->update([
            'quantite' => $request->quantite
        ]);

        return response()->json(['message' => 'Mise à jour réussie'], 200);
    }

    public function destroy($cellier_id, BouteilleCellier $bouteille_cellier)
    {
        BouteilleCellier::select()->where('id', $bouteille_cellier->id)->delete();
        return redirect(route('cellier.show', $cellier_id));
    }
    // fonction recherche & filtrage
    public function rechercheEtFiltrage(Request $request, $cellier_id)
    {
        $cellier = Cellier::findOrFail($cellier_id);
    
        $nomBouteille = $request->input('keyword');
        $typeVin = $request->input('filtrage');
        $anneeVin = $request->filled('annee_vin') ? $request->input('annee_vin') : null;
        $paysVin = $request->input('pays');
        $imageVin = $request->input('image');
        $prixMin = $request->filled('prix_min') ? $request->input('prix_min') : null;
        $prixMax = $request->filled('prix_max') ? $request->input('prix_max') : null;
        $sort = $request->input('sort', '');
    
        $bouteilleQuery = $cellier->bouteillesCelliers()
            ->when($nomBouteille, function ($query) use ($nomBouteille) {
                $query->whereHas('bouteille', function ($subquery) use ($nomBouteille) {
                    $subquery->where('nom', 'like', "$nomBouteille%")
                        ->orWhere('type', 'like', "$nomBouteille%");
                });
            })
            ->when($typeVin, function ($query) use ($typeVin) {
                $query->whereHas('bouteille', function ($subquery) use ($typeVin) {
                    $subquery->where('type', $typeVin);
                });
            })
            ->when($anneeVin !== null, function ($query) use ($anneeVin) {
                $query->whereHas('bouteille', function ($subquery) use ($anneeVin) {
                    $subquery->where('annee', $anneeVin);
                });
            })
            ->when($paysVin, function ($query) use ($paysVin) {
                $query->whereHas('bouteille', function ($subquery) use ($paysVin) {
                    $subquery->where('pays', $paysVin);
                });
            })
            ->when($imageVin !== null, function ($query) use ($imageVin) {
                $query->whereHas('bouteille', function ($subquery) use ($imageVin) {
                    $subquery->where('srcImage', $imageVin ? '!=' : '=', null);
                });
            })
            ->when($prixMin, function ($query) use ($prixMin) {
                $query->whereHas('bouteille', function ($subquery) use ($prixMin) {
                    $subquery->where('prix', '>=', $prixMin);
                });
            })
            ->when($prixMax, function ($query) use ($prixMax) {
                $query->whereHas('bouteille', function ($subquery) use ($prixMax) {
                    $subquery->where('prix', '<=', $prixMax);
                });
            })
            ->when($sort, function ($query) use ($sort) {
                if ($sort == 'name-asc') {
                    $query->orderBy('bouteille.nom');
                } elseif ($sort == 'name-desc') {
                    $query->orderByDesc('bouteille.nom');
                } elseif ($sort == 'price-asc') {
                    $query->orderBy('bouteille.prix');
                } elseif ($sort == 'price-desc') {
                    $query->orderByDesc('bouteille.prix');
                }
            });
    
        $bouteilles = $bouteilleQuery->get();
    
        return view('cellier.show-search', compact('cellier', 'bouteilles'));
    }
    


}
