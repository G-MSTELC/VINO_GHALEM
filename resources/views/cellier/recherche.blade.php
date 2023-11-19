<!-- resources/views/cellier/recherche.blade.php -->
@extends('layouts.app')

@section('title', 'Résultats de la recherche')

@section('content')
    <header>
        @isset($cellier)
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}" class="btn-arrow-top">
            </a>
        @else
            <a href="{{ route('cellier.index') }}" class="btn-arrow-top">
            </a>
            <a href="{{ route('cellier.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter un cellier
            </a>
        @endisset
    </header>
    <main class="nav-margin">
        <h1>Résultats de la recherche</h1>

        <!-- Formulaire de recherche par mot-clé -->
        <form action="{{ route('rechercheEtFiltrage.cellier', ['cellier_id' => $cellier->id]) }}" method="post" class="form-inline">
            @csrf
            <label for="keyword" class="sr-only">Recherche par mot-clé :</label>
            <input type="text" name="keyword" id="keyword" class="form-control mb-2 mr-sm-2" placeholder="Recherche par mot-clé" value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
        </form>

        <!-- Formulaire de filtrage -->
        <form action="{{ route('rechercheEtFiltrage.cellier', ['cellier_id' => $cellier->id]) }}" method="post" class="form-inline">
            @csrf

            <label for="filtrage" class="sr-only">Filtrer par type de vin :</label>
            <select name="filtrage" id="filtrage" class="custom-select mb-2 mr-sm-2">
                <option value="" {{ request('filtrage') == '' ? 'selected' : '' }}>Tous les types</option>
                <option value="rouge" {{ request('filtrage') == 'rouge' ? 'selected' : '' }}>Vin Rouge</option>
                <option value="blanc" {{ request('filtrage') == 'blanc' ? 'selected' : '' }}>Vin Blanc</option>
            </select>

            <label for="image" class="sr-only">Filtrer par image :</label>
            <select name="image" id="image" class="custom-select mb-2 mr-sm-2">
                <option value="" {{ request('image') == '' ? 'selected' : '' }}>Toutes les images</option>
                <option value="1" {{ request('image') == '1' ? 'selected' : '' }}>Avec image</option>
                <option value="0" {{ request('image') == '0' ? 'selected' : '' }}>Sans image</option>
            </select>

            <label for="pays" class="sr-only">Filtrer par pays :</label>
            <select name="pays" id="pays" class="custom-select mb-2 mr-sm-2">
                <option value="" {{ request('pays') == '' ? 'selected' : '' }}>Tous les pays</option>
                
            </select>

            <label for="annee_vin" class="sr-only">Année (alternative) :</label>
            <input type="number" name="annee_vin" class="form-control mb-2 mr-sm-2" placeholder="Année (laisser vide pour ignorer)" value="{{ request('annee_vin') }}">

            <button type="button" class="btn btn-primary mb-2 mr-sm-2" data-toggle="collapse" data-target="#collapseFiltrage" aria-expanded="false" aria-controls="collapseFiltrage">
                Filtrage
            </button>

        
            <div class="collapse" id="collapseFiltrage">
                
            </div>

            <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
        </form>

        <!-- Afficher les résultats de la recherche -->
        @if(isset($bouteilles) && $bouteilles->isNotEmpty())
            <ul>
                @foreach ($bouteilles as $bouteille)
                    <li>
                        {{ $bouteille->bouteille->nom }} - {{ $bouteille->bouteille->type }} - {{ $bouteille->bouteille->region }} - {{ $bouteille->bouteille->annee }}
                        @if ($bouteille->bouteille->image)
                            <img src="{{ asset('images/' . $bouteille->bouteille->image) }}" alt="Image de la bouteille">
                        @else
                            <span>Aucune image disponible</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucun résultat trouvé.</p>
        @endif

        <!-- Retour au cellier ou à la liste des celliers -->
        @if(isset($cellier))
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}">Retour au cellier</a>
        @else
            <a href="{{ route('cellier.index') }}">Retour à la liste des celliers</a>
        @endif

        <!-- Voir les bouteilles dans le cellier -->
        @if(isset($cellierId) && $cellierId)
            <a href="{{ route('bouteille.index', ['cellier_id' => $cellierId]) }}">Voir les bouteilles</a>
        @endif
    </main>
@endsection
