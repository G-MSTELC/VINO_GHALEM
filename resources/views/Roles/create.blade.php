@extends('layouts.app')

@section('title', "Création d'un rôle")

@section('content')
    <header>
        Création d'un rôle
    </header>
    <main>
        <h1>Création d'un rôle</h1>
        <div>
            <!-- Formulaire de création d'un rôle -->
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                <div>
                    <label for="name">Nom du rôle</label>
                    <input type="text" id="name" name="name">
                </div>
                <div>
                    <input type="submit" class="btn-submit" value="Créer">
                </div>
            </form>
        </div>
    </main>
@endsection
