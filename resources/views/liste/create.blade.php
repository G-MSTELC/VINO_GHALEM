<!-- Création d'une nouvelle liste -->

@extends('layouts.app')
@section('content')
    <main class="form-border nav-margin">
        <h1 class="form-h1">
            Ajouter une liste
        </h1>
        <div class="form-container">
            <form action="" method="post" id="ajouterListe">
                @csrf
                <div class="form-input-container">
                    <label for="nom">Nom de la liste</label>
                    <input type="text" id="nom" name="nom">
                    @if ($errors->has('nom')) 
                        <div>{{ $errors->first('nom') }}</div>
                    @endif
                </div>
                <div class="form-button">
                    <button type="submit" form="ajouterListe" class="btn-submit">Créer liste</button>
                </div>
            </form>
        </div>
    </main>
@endsection