@extends('layouts.app')

@section('title', 'Résultats de la recherche')

@section('styles')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/buttons/btn-test.css') }}">
@endsection

@section('content')
    <header>
        @isset($cellier)
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}" class="btn-arrow-top"></a>
        @else
            <a href="{{ route('cellier.index') }}" class="btn-arrow-top"></a>
            <a href="{{ route('cellier.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter un cellier
            </a>
        @endisset
    </header>

    <main class="nav-margin">
        <h1>Résultats de la recherche</h1>

        <!-- Formulaire de recherche par mot-clé, phrase ou nom de bouteille -->
        <form action="{{ route('rechercheEtFiltrage.cellier', ['cellier_id' => $cellier->id]) }}" method="post" class="form-inline">
            @csrf
            <label for="keyword" class="sr-only">Recherche par mot-clé, phrase ou nom de bouteille :</label>
            <input type="text" name="keyword" id="keyword" class="form-control mb-2 mr-sm-2" placeholder="Recherche par mot-clé, phrase ou nom de bouteille" value="{{ request('keyword') }}">

            <!-- Formulaire de filtrage par type -->
            <div class="form-group">
                <label for="type" class="sr-only">Filtrer par type de vin :</label>
                <select name="type" id="type" class="custom-select mb-2 mr-sm-2">
                    <option value="" {{ request('type') == '' ? 'selected' : '' }}>Tous les types</option>
                    <option value="rouge" {{ request('type') == 'rouge' ? 'selected' : '' }}>Vin Rouge</option>
                    <option value="blanc" {{ request('type') == 'blanc' ? 'selected' : '' }}>Vin Blanc</option>
                </select>
            </div>

            <!-- Formulaire de filtrage par région -->
            <div class="form-group">
                <label for="region" class="sr-only">Filtrer par région :</label>
                <input type="text" name="region" id="region" class="form-control mb-2 mr-sm-2" placeholder="Entrez la région" value="{{ request('region') }}">
            </div>

            <!-- Formulaire de filtrage par pays -->
            <div class="form-group">
                <label for="pays" class="sr-only">Filtrer par pays :</label>
                <input type="text" name="pays" id="pays" class="form-control mb-2 mr-sm-2" placeholder="Entrez le pays" value="{{ request('pays') }}">
            </div>

            <!-- Formulaire de filtrage par année -->
            <div class="form-group">
                <label for="annee_vin" class="sr-only">Année (facultatif) :</label>
                <input type="number" name="annee_vin" class="form-control mb-2 mr-sm-2" placeholder="Année (laisser vide pour ignorer)" value="{{ request('annee_vin') }}">
            </div>

            <!-- Formulaire de filtrage par image -->
            <div class="form-group">
                <label for="image" class="sr-only">Filtrer par image :</label>
                <select name="image" id="image" class="custom-select mb-2 mr-sm-2">
                    <option value="" {{ request('image') == '' ? 'selected' : '' }}>Toutes les images</option>
                    <option value="1" {{ request('image') == '1' ? 'selected' : '' }}>Avec image</option>
                    <option value="0" {{ request('image') == '0' ? 'selected' : '' }}>Sans image</option>
                </select>
            </div>

            <!-- Formulaire de filtrage par prix minimum -->
            <div class="form-group">
                <label for="prix_min" class="sr-only">Prix minimum :</label>
                <input type="number" name="prix_min" class="form-control mb-2 mr-sm-2" placeholder="Prix minimum" value="{{ request('prix_min') }}">
            </div>

            <!-- Formulaire de filtrage par prix maximum -->
            <div class="form-group">
                <label for="prix_max" class="sr-only">Prix maximum :</label>
                <input type="number" name="prix_max" class="form-control mb-2 mr-sm-2" placeholder="Prix maximum" value="{{ request('prix_max') }}">
            </div>

            <button type="button" class="btn btn-primary mb-2 mr-sm-2" data-toggle="collapse" data-target="#collapseFiltrage" aria-expanded="false" aria-controls="collapseFiltrage">
                Filtrage
            </button>

            <div class="collapse" id="collapseFiltrage">
               
            </div>

            <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
        </form>

        @if(isset($bouteilles) && $bouteilles->isNotEmpty())
            <div class="resultats-container">
                @foreach ($bouteilles as $bouteille)
                    <div class="card">
                        @if ($bouteille->bouteille->srcImage || $bouteille->bouteille->srcsetImage)
                            @php
                                $imagePath = $bouteille->bouteille->srcImage ? $bouteille->bouteille->srcImage : $bouteille->bouteille->srcsetImage;
                                $imagePath = Str::startsWith($imagePath, 'http') ? $imagePath : asset('images/' . $imagePath);
                            @endphp
                            <img src="{{ $imagePath }}" alt="Image de la bouteille">
                        @else
                            <span>Aucune image disponible</span>
                        @endif

                        <h3>{{ $bouteille->bouteille->nom }}</h3>
                        <p>Type: {{ $bouteille->bouteille->type }}</p>
                        <p>Région: {{ $bouteille->bouteille->region }}</p>
                        <p>Année: {{ $bouteille->bouteille->annee }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>Aucun résultat trouvé.</p>
        @endif

        @if(!isset($cellier) && (!isset($bouteilles) || $bouteilles->isEmpty()))
            <a href="{{ route('cellier.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter un cellier
            </a>
        @endif

        <!-- Retour au cellier ou à la liste des celliers -->
        @if(isset($cellier))
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}">Retour au cellier</a>
        @else
            <a href="{{ route('cellier.index') }}">Retour à la liste des celliers</a>
        @endif

        @if(isset($cellierId) && $cellierId)
            <a href="{{ route('bouteille.index', ['cellier_id' => $cellierId]) }}">Voir les bouteilles</a>
        @endif
    </main>
@endsection
