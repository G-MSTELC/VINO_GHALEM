<!-- Modifier le nom d'un cellier -->

@extends('layouts.app')
@section('content')
    <main class="form-border nav-margin">
        <h1 class="form-h1">
            Modifier un cellier
        </h1>
        <div class="form-container">
            <form method="post" id="modifierCellier">
                @method('put')
                @csrf
                <div class="form-input-container">
                    <label for="nom">Nom du cellier</label>
                    <input type="text" id="nom" name="nom" value="{{ $cellier->nom }}">
                    @if ($errors->has('nom')) 
                        <div>{{ $errors->first('nom') }}</div>
                    @endif
                </div>
                <div class="form-button">
                    <button type="submit" form="modifierCellier" class="btn-submit">Mettre à jour</button>
                </div>
            </form>
        </div>
    </main>

@endsection