<!-- Une liste et ses bouteilles -->
@extends('layouts.app')
@section('title', 'Liste')
@section('content')
    <!-- <header class="title-container"> -->
    <header>
        <a href="{{ route('liste.index') }}" class="btn-arrow-top">
            <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.4247 7C17.977 7 18.4247 7.44772 18.4247 8C18.4247 8.55228 17.977 9 17.4247 9L17.4247 7ZM0.498398 8.70711C0.107874 8.31658 0.107874 7.68342 0.498398 7.29289L6.86236 0.928933C7.25288 0.538409 7.88605 0.538409 8.27657 0.928933C8.6671 1.31946 8.6671 1.95262 8.27657 2.34315L2.61972 8L8.27657 13.6569C8.6671 14.0474 8.6671 14.6805 8.27657 15.0711C7.88605 15.4616 7.25288 15.4616 6.86236 15.0711L0.498398 8.70711ZM17.4247 9L1.20551 9L1.20551 7L17.4247 7L17.4247 9Z" fill="black"/>
            </svg>
            listes
        </a>
    </header>
    <!-- <main> -->
    <main class="nav-margin">
        <h1 class="btn-modify">{{ $liste->nom }}
            <a href="{{ route('liste.edit', $liste->id) }}">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 15V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21H3C2.46957 21 1.96086 20.7893 1.58579 20.4142C1.21071 20.0391 1 19.5304 1 19V5C1 4.46957 1.21071 3.96086 1.58579 3.58579C1.96086 3.21071 2.46957 3 3 3H7" stroke="#3B3B3B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.5 14.8L21 5.2L16.8 1L7.3 10.5L7 15L11.5 14.8Z" stroke="#3B3B3B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </h1>
        <a href="{{ route('bouteille.index') }}" class="btn-arrow btn-round">
            Ajouter une bouteille
            <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.83728 7C1.285 7 0.83728 7.44772 0.83728 8C0.83728 8.55228 1.285 9 1.83728 9L1.83728 7ZM18.5986 8.70711C18.9891 8.31658 18.9891 7.68342 18.5986 7.29289L12.2347 0.928933C11.8441 0.538409 11.211 0.538409 10.8205 0.928933C10.4299 1.31946 10.4299 1.95262 10.8205 2.34315L16.4773 8L10.8204 13.6569C10.4299 14.0474 10.4299 14.6805 10.8204 15.0711C11.211 15.4616 11.8441 15.4616 12.2347 15.0711L18.5986 8.70711ZM1.83728 9L17.8915 9L17.8915 7L1.83728 7L1.83728 9Z" fill="white"/>
            </svg>
        </a>
        <div class="form-container">
            <form action="{{ route('liste.show', ['liste_id' => $liste->id]) }}" method="">
                @csrf
                <div class="form-input-container">
                    <label for="sortCellier">TRIER</label>
                    <select id="sortCellier">
                        <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Nom du produit (A-Z)</option>
                        <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Nom du produit (Z-A)</option>
                        <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Prix ($-$$$)</option>
                        <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Prix ($$$-$)</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="card-count">
            <p>                
                @if($liste->bouteillesListes->count() > 0)
                    {{ $liste->bouteillesListes->count() }} bouteille(s)
                @else 
                    Aucune bouteille
                @endif
            </p>
        </div>
        @foreach($liste->bouteillesListes as $bouteillesListes)
        <section class="card-bouteille" id="{{ $bouteillesListes->id }}" data-location="listes">
            <picture>
                <img src="{{ $bouteillesListes->bouteille->srcImage }}" alt="{{ $bouteillesListes->bouteille->nom }}">
            </picture>
            <div class="card-bouteille-content">
                <div class="card-bouteille-info">
                    <a href="{{ route('bouteille.show', ['bouteille_id' => $bouteillesListes->bouteille->id]) }}">
                        <h2>{{ $bouteillesListes->bouteille->nom }}</h2>
                    </a>
                    <span>
                        {{ $bouteillesListes->bouteille->type }} | {{ $bouteillesListes->bouteille->format }} | {{ $bouteillesListes->bouteille->pays }}
                    </span>
                    <p>
                        {{ $bouteillesListes->bouteille->prix }} $
                    </p>
                </div>
                <div class="card-bouteille-qt">
                    <button class="btn-decrement">-</button>
                    <input type="text" value="{{ $bouteillesListes->quantite }}" min="0" readonly>
                    <button class="btn-increment">+</button>
                    <form action="" class="form-delete"></form>
                </div>
                <a href="#deplacerbouteille" class="btn-deplacer">Déplacer</a>
            </div>
        </section>
        @endforeach
        <!-- <div class="modal-container"> -->
        <dialog id="modal-deplacer" class="modal">
                <h2>Déplacer vers un cellier</h2>
                <hr>
                <form action="" class="form-modal">
                    <div class="form-input-container">
                        <label for="cellier-location">CELLIER</label>
                        <select name="cellier-location" id="cellier-location">
                            @forelse ($celliers as $cellier)
                                <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
                            @empty 
                                <option value="">Vous n'avez aucun cellier</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="card-bouteille-qt">
                        <button class="btn-decrement">-</button>
                        <input type="text" value="1" min="1" readonly>
                        <button class="btn-increment">+</button>
                    </div>
                    <div class="btn-modal-container">
                        <button class="btn-modal-action">déplacer</button>
                        <button class="btn-modal-cancel">annuler</button>
                    </div>
                </form>
            </dialog>
        <!-- </div> -->
        
        <script src="{{ asset('js/sortBottles.js') }}"></script>
        <script src="{{ asset('js/bottleCounter.js') }}"></script>
        <script src="{{ asset('js/modalDeplacer.js') }}"></script>
    </main>
@endsection