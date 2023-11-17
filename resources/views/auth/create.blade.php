@extends('layouts.app')
@section('title', 'Bienvenue')
@section('content')
<header>
    vino
</header>
<main class="form-border">
    <h1 class="form-h1">
        Créer un compte
    </h1>
    <div class="form-container">
        <form action="{{ route('register.store') }}" method="post" id="registration">
            @csrf
            <div class="form-input-container">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom">
                @error('nom')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-input-container">
                <label for="email">Courriel</label>
                <input type="text" id="email" name="email">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-input-container">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-input-container">
                <label for="repeat-password">Répéter mot de passe</label>
                <input type="password" id="repeat-password" name="password_confirmation">
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-button">
                <button type="submit" class="btn-submit">créer</button>
            </div>
            <a href="{{ route('login') }}" class="btn-submit">connexion</a>
        </form>
    </div>
</main>

@endsection