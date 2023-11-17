@extends('layouts.app')
@section('title','Recherche')
@section('content')

<body>
        <header>
            ajouter une bouteille
        </header>
        <main class="nav-margin">
            <section class="form-ajouter-bouteille"> 
                <div class="form-container">
                    <form action="{{ route('bouteille.search') }}" method="" id="">
                        <!-- @csrf -->
                        <div class="form-input-container">
                            <label for="search">RECHERCHE</label>
                            <input type="text" id="search" name="search">
                        </div>
                    </form>
                    
                </div>
                <div class="link link-right">
                    <a href="#">BOUTEILLE PERSONNALISÉE</a>
                </div>
                <div class="form-container">
                    <form action="" method="" id="">
                        <hr>
                        <details>
                            <summary>Filtrer</summary>
                            <div class="form-input-container">
                                <label for="color">Couleur</label>
                                <select name="color" id="color">
                                    <option value="">Choisir les options</option>
                                    <option value="white">Blanc</option>
                                </select>
                            </div>
                            <div class="form-input-container">
                                <label for="format">Format</label>
                                <select name="format" id="format">
                                    <option value="">Choisir les options</option>
                                    <option value="750">750ml</option>
                                </select>
                            </div>
                            <div class="form-input-container">
                                <label for="prix">Prix</label>
                                <!-- <span>Erreur prix</span> -->
                                <div>
                                    <div>
                                        <label for="prix_min">Minimum</label>
                                        <input id="prix_min" type="number">
                                    </div>
                                    <div>
                                        <label for="prix_max">Maximum</label>
                                        <input id="prix_max" type="number">
                                    </div>
                                </div>
                            </div>
                            <div class="form-input-container">
                                <label for="country">Pays</label>
                                <select name="country" id="country">
                                    <option value="">Choisir les options</option>
                                    <option value="canada">Canada</option>
                                    <option value="usa">États-Unis</option>
                                    <option value="espagne">Espagne</option>
                                    <option value="france">France</option>
                                    <option value="italie">Italie</option>
                                </select>
                            </div>
                            <div class="form-input-container">
                                <label for="region">Région</label>
                                <select name="region" id="region">
                                    <option value="">Choisir les options</option>
                                    <option value="quebec">Québec</option>
                                </select>
                            </div>
                            <div class="form-input-container">
                                <label for="year">Millésime</label>
                                <select name="year" id="year">
                                    <option value="">Choisir les options</option>
                                    <option value="2001">2001</option>
                                </select>
                            </div>
                            <div class="form-input-container">
                                <label for="grape">Cépage</label>
                                <select name="grape" id="grape">
                                    <option value="">Choisir les options</option>
                                    <option value="cabernet-sauv">Cabernet-Sauvignon</option>
                                </select>
                            </div>
                        </details>                        
                        <div class="tag-container"></div>
                    </form>
                </div>
                <div class="form-container">
                    <hr>
                    <form action="{{ route('bouteille.sorting') }}" method="" id="sortingForm">
                        <!-- @csrf -->
                        <div class="form-input-container">
                            <label for="sort">TRIER</label>
                            <select name="sort" id="sort">
                                {{-- <option value="defaut" {{ request('sorter') == 'defaut' ? 'selected' : '' }}></option> --}}

                                <option value="name-asc" {{ request('sort') == 'name-asc' ? 'selected' : '' }}>Nom du produit (A-Z)</option>
                                <option value="name-desc" {{ request('sort') == 'name-desc' ? 'selected' : '' }}>Nom du produit (Z-A)</option>
                                <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Prix ($-$$$)</option>
                                <option value="price-desc" {{ request('sortt') == 'price-desc' ? 'selected' : '' }}>Prix ($$$-$)</option>
                            </select>
                        </div>
                    </form>
                </div>
            </section>
            <div class="card-count">
                <p>{{$bouteilles->total()}} bouteilles :</p>
            </div>
            @foreach ($bouteilles as $bouteille)
            <section class="card-bouteille">
                <picture>
                    <img src="{{ $bouteille->srcImage }}" alt="{{ $bouteille->nom}}">
                </picture>
                <div class="card-bouteille-content">
                    <div class="card-bouteille-info">
                        <h2><a href="#">{{ $bouteille->nom }}</a></h2>
                        <span>{{$bouteille->type}} | {{ $bouteille->format }} | {{$bouteille->pays}}</span>
                        <p>{{$bouteille->prix}} $</p>
                    </div>
                    <a href="" class="btn-ajouter">+ Ajouter</a>
                </div>
            </section>
          
            @endforeach  
            {{ $bouteilles->appends(request()->query())->links('pagination.custom') }}
        </section>
    </main>
    @endsection

            <!-- <div class="modal-container"> -->
                <dialog id="modal-ajouter" class="modal">
                        <h2>Confirmation d'ajout</h2>
                        <hr>
                        <form action="" class="form-modal">
                                <div class="form-radio">
                                    <input type="radio" id="location-cellier" name="location" checked >
                                    <label for="location-cellier">Celliers</label><br>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" id="location-liste" name="location">
                                    <label for="location-liste">Listes</label>
                                </div>
                                <div class="form-input-container">
                                    <label for="cellier-location">Millésime</label>
                                    <select name="cellier-location" id="cellier-location">
                                        <option value="">Maison</option>
                                        <option value="">Cottage</option>
                                        <option value="">Bureau</option>
                                    </select>
                                </div>
                                <div class="card-bouteille-qt">
                                    <button class="btn-decrement">-</button>
                                    <input type="text" value="1" min="1" readonly>
                                    <button class="btn-increment">+</button>
                                </div>
                                <div class="btn-modal-container">
                                    <button class="btn-modal-action">ajouter</button>
                                    <button class="btn-modal-cancel">annuler</button>
                                </div>
                        </form>
                </dialog>
            <!-- </div> -->
            <script src="../../js/bottleCounterModal.js"></script>
            <script src="../../js/modalAjouter.js"></script>
            <script src="../../js/filterTag.js"></script>
        </main>
        