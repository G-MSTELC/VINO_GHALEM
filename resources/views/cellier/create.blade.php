<!-- Création d'un nouveau cellier -->

@extends('layouts.app')

@section('content')
    <main class="form-border nav-margin">
        <h1 class="form-h1">
            Ajouter un cellier
        </h1>
        <div class="form-container">
            <form action="{{ route('cellier.store') }}" method="post" id="ajouterCellier">
                @csrf
                <div class="form-input-container">
                    <label for="nom">Nom du cellier</label>
                    <input type="text" id="nom" name="nom">
                    @if ($errors->has('nom')) 
                        <div>{{ $errors->first('nom') }}</div>
                    @endif
                </div>
                <div class="form-button">
                    <button type="submit" form="ajouterCellier" class="btn-submit">Créer cellier</button>
                </div>
            </form>
        </div>
    </main>
@endsection
