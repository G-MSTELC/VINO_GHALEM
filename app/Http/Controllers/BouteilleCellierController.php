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
        $critereTri = $request->input('tri', 'created_at'); // Tri par défaut par date de création
    
        // Récupérez également les détails du cellier pour le passer à la vue
        $cellier = Cellier::find($cellierId);
    
        $bouteilles = BouteilleCellier::triParCritere($critereTri)
            ->where('cellier_id', $cellierId)
            ->get();
    
        return view('cellier.index', compact('bouteilles', 'cellier', 'cellierId'));
    }
    
    public function create()
    {
        // Code pour la création d'une bouteille dans le cellier
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
        // Code pour afficher une bouteille spécifique dans le cellier
    }

    public function edit(BouteilleCellier $bouteilleCellier)
    {
        // Code pour l'édition d'une bouteille dans le cellier
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
}
