<!-- resources/views/cellier/recherche.blade.php -->

@extends('layouts.app')

@section('title', 'Résultats de la recherche')

<!-- Utiliser la section 'recherche' au lieu de 'content' -->
@section('recherche')
    <!-- resources/views/cellier/recherche-content.blade.php -->

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

    <!-- Formulaire de recherche dans le cellier actuel -->
    <form action="{{ route('recherche.cellier', ['cellier' => $cellier->id]) }}" method="get">
        @csrf
        <label for="search">Recherche :</label>
        <input type="text" name="search" id="search" value="{{ request('search') }}">
        <button type="submit">Rechercher</button>
    </form>


    <!-- Afficher les résultats de la recherche -->
    @if(isset($resultats) && $resultats->isNotEmpty())
        <ul>
            @foreach ($resultats as $resultat)
                <li>
                    @if(isset($resultat['bouteille']))
                        {{ $resultat['bouteille']->nom }} - {{ $resultat['bouteille']->type }} - {{ $resultat['bouteille']->region }} - {{ $resultat['bouteille']->annee }}
                    @endif

                    @if(isset($resultat['cellier']))
                        (Cellier : {{ $resultat['cellier']->nom }})
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
