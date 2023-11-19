<!-- resources/views/cellier/recherche.blade.php -->
@extends('layouts.app')

@section('title', 'Résultats de la recherche')

@section('content')
    <header>
        @isset($cellier)
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}" class="btn-arrow-top">
                <!-- Bouton de retour au cellier -->
            </a>
        @else
            <a href="{{ route('cellier.index') }}" class="btn-arrow-top">
                <!-- Bouton de retour à la liste des celliers -->
            </a>
        @endisset
    </header>
    <main class="nav-margin">
        <h1>Résultats de la recherche</h1>

<!-- Formulaire de recherche et filtrage -->

<form action="{{ route('rechercheEtFiltrage.cellier', ['cellier_id' => $cellier->id]) }}" method="post">
    @csrf
    <label for="search">Recherche par nom :</label>
    <input type="text" name="search" id="search" value="{{ request('search') }}">

    <label for="filtrage">Filtrer par :</label>
    <select name="filtrage" id="filtrage">
        <option value="rouge" {{ request('filtrage') == 'rouge' ? 'selected' : '' }}>Vin Rouge</option>
        <option value="blanc" {{ request('filtrage') == 'blanc' ? 'selected' : '' }}>Vin Blanc</option>
        
    </select>

    <label for="annee_vin">Année (alternative) :</label>
    <input type="number" name="annee_vin" placeholder="Année (laisser vide pour ignorer)" value="{{ request('annee_vin') }}">

    <!-- Boutons de recherche et de filtre -->
    <button type="submit">Rechercher</button>
</form>

<!-- Afficher les résultats de la recherche -->
@if(isset($bouteilles) && $bouteilles->isNotEmpty())
    <ul>
        @foreach ($bouteilles as $bouteille)
            <li>
                {{ $bouteille->bouteille->nom }} - {{ $bouteille->bouteille->type }} - {{ $bouteille->bouteille->region }} - {{ $bouteille->bouteille->annee }}
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
