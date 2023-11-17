<?php

namespace App\Http\Controllers;

use App\Models\BouteilleListe;
use Illuminate\Http\Request;

class BouteilleListeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        BouteilleListe::updateOrCreate(
            ['liste_id' => $request->location_id, 'bouteille_id' => $request->bouteille_id],
            ['quantite' => $request->quantite]
        ); 

        return response()->json(['message' => 'Mise à jour réussie'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BouteilleListe  $bouteilleListe
     * @return \Illuminate\Http\Response
     */
    public function show(BouteilleListe $bouteilleListe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BouteilleListe  $bouteilleListe
     * @return \Illuminate\Http\Response
     */
    public function edit(BouteilleListe $bouteilleListe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BouteilleListe  $bouteilleListe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            ['quantite' => 'required|min: 0|integer'],
            [
                'quantite.required' => 'La quantité est obligatoire.', 
                'quantite.min' => 'La quantité doit être supérieure ou égale à zéro.',
                'quantite.integer' => 'La quantité doit être entière, sans décimal.'
            ]
        ); 

        BouteilleListe::findOrFail($id)->update([
            'quantite' => $request->quantite
        ]);

        return response()->json(['message' => 'Mise à jour réussie'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BouteilleListe  $bouteilleListe
     * @return \Illuminate\Http\Response
     */
    public function destroy(BouteilleListe $bouteilleListe)
    {
        //
    }
}
