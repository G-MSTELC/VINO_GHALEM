<!-- resources/views/cellier/show-search.blade.php -->
@extends('layouts.app')

@section('title', 'Recherche dans le cellier')

@section('content')
    <header>
        @isset($cellier)
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}" class="btn-arrow-top">
            </a>
        @else
            <a href="{{ route('cellier.index') }}" class="btn-arrow-top">
                
            </a>
        @endisset
    </header>
    
    <main class="nav-margin">
        <h1>Résultats de la recherche</h1>

        @include('cellier.recherche', ['cellier' => $cellier])

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
            <a href="{{ route('bouteille.index', ['cellier_id' => $cellier->id]) }}">Voir les bouteilles</a>
        @endif
    </main>
@endsection
