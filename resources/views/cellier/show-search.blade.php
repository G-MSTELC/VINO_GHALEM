<!-- cellier/show-search.blade.php -->
@extends('layouts.app')

@section('title', 'Recherche dans le cellier')

@section('content')
    <header>
        @if(optional($cellier)->id)
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}" class="btn-arrow-top">
                <!-- ... bouton de retour au cellier ... -->
            </a>
        @else
            <a href="{{ route('cellier.index') }}" class="btn-arrow-top">
                
            </a>
        @endif
    </header>
    <main class="nav-margin">
        <!-- Affichage du formulaire de tri -->
        <form method="GET" action="{{ route('cellier.tri') }}">
            @csrf
            <!-- ... Champs de tri ... -->
            <button type="submit">Trier</button>
        </form>

        <!-- Affichage du formulaire de recherche -->
        <form method="POST" action="{{ route('recherche') }}">
            @csrf
          
            <button type="submit">Rechercher</button>
        </form>

        <!-- Affichage des résultats triés -->
        @if(isset($resultats) && $resultats->isNotEmpty())
            <h1>Résultats triés pour le cellier</h1>
            @foreach ($resultats as $bouteille)
                <div>
                    {{ $bouteille['bouteille']->nom }} - {{ $bouteille['bouteille']->type }} - {{ $bouteille['bouteille']->region }} - {{ $bouteille['bouteille']->annee }}
                    @if(isset($bouteille['cellier']))
                        (Cellier : {{ $bouteille['cellier']->nom }})
                    @endif
                </div>
            @endforeach
        @else
            <p>Aucun résultat trouvé.</p>
        @endif

        
        @if(optional($cellier)->id)
            <a href="{{ route('cellier.show', ['cellier_id' => $cellier->id]) }}">Retour au cellier</a>
        @else
            <a href="{{ route('cellier.index') }}">Retour à la liste des celliers</a>
        @endif

        @if(isset($cellierId))
            <a href="{{ route('bouteille.index', ['cellier_id' => $cellierId]) }}">Voir les bouteilles</a>
        @endif
    </main>
@endsection
