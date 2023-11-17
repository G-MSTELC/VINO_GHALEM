@extends('layouts.app')

@section('title', "Modifier le rôle")

@section('content')
    <header>
        Modifier le rôle
    </header>
    <main>
        <h1>Modifier le rôle</h1>
        <div>
            <!-- Formulaire de modification d'un rôle existant -->
            <form action="{{ route('roles.update', $role->id) }}" method="post">
                @method('put')
                @csrf
                <div class="form-input-container">
                    <label for="name">Nom du rôle</label>
                    <input type="text" id="name" name="name" value="{{ $role->name }}">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <input type="submit" class="btn-submit" value="Modifier le rôle">
                </div>
            </form>
        </div>
    </main>
@endsection
