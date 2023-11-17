<!-- Modification du nom d'une liste d'achat et supression -->

@extends('layouts.app')
@section('content')
    <main class="form-border nav-margin">
        <h1 class="form-h1">
            Modifier une liste
        </h1>
        <div class="form-container">
            <form method="post" id="modifierListe">
                @method('put')
                @csrf
                <div class="form-input-container">
                    <label for="nom">Nom de la liste</label>
                    <input type="text" id="nom" name="nom" value="{{ $liste->nom }}">
                    @if ($errors->has('nom')) 
                        <div>{{ $errors->first('nom') }}</div>
                    @endif
                </div>
                <div class="form-button">
                    <button type="submit" form="modifierListe" class="btn-submit">Mettre à jour</button>
                </div>
            </form>
        </div>
    </main>

@endsection