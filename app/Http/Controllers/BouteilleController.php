<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BouteilleController extends Controller
{
    /**
     * Affiche la liste des bouteilles en page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bouteilles = Bouteille::paginate(7);
        $celliers = Cellier::where('user_id', Auth::id())->get();
        return view('bouteille.index', ['bouteilles'=> $bouteilles, 'celliers' => $celliers]);
    }


    public function search(Request $request) {

        $searchTerm = $request->input('search');
        $bouteilles = Bouteille::where('nom', 'like', "%$searchTerm%")->paginate(3);
               
      return view('bouteille.show-search', ['bouteilles' => $bouteilles]);
    }

    public function sorting (Request $request) {

        $sort = $request->input('sort');
        switch ($sort) {
            case 'price-asc':
                $bouteilles = Bouteille::orderBy('prix', 'asc')->paginate(3);
                break;
            case 'price-desc':
                $bouteilles = Bouteille::orderBy('prix', 'desc')->paginate(3);
                break;
            case 'name-asc':
                $bouteilles = Bouteille::orderBy('nom', 'asc')->paginate(3);
                break;
            case 'name-desc':
                $bouteilles = Bouteille::orderBy('nom', 'desc')->paginate(3);
                break;
            default:
                $bouteilles = Bouteille::all();
                break;
        }
        return view('bouteille.show-sorting', compact('bouteilles'));
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bouteille = Bouteille::findOrFail($id);
        return view('bouteille.show', ['bouteille'=> $bouteille]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function edit(Bouteille $bouteille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bouteille $bouteille)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille)
    {
        //
    }
}
