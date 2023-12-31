@extends('layouts.app')

@section("title", "Profil")

@section('content')
<header>
    Profil
</header>
<main class="nav-margin">
    <section>
        <h2>Mes informations</h2>
        <div class="info-profil"><span>Nom :</span><span class="info-value">{{ $user->nom }}</span></div>
        <div class="info-profil"><span>Courriel :</span><span class="info-value">{{ $user->email }}</span></div>

        <div class="btn-container">
            <a href="{{ route('profil.edit', ['user' => $user->id]) }}" class="btn-action btn-round btn-mt">
                Modifier mon profil
            </a>
        </div>
    </section>
    <section>
        <h2>Mon compte</h2>
        <div class="btn-container">
            <a href="{{ route('logout') }}" class="btn-action btn-round btn-grey">
                Me déconnecter
            </a>
        </div>
        <div class="btn-container">
            <a href="#" class="btn-action btn-round btn-red btn-supprimer">
                Supprimer mon compte
            </a>
        </div>
    </section>

    <!-- <div class="modal-container"> -->
        <dialog id="modal-supprimer" class="modal">
            <h2>Suppression de compte</h2>
            <hr>
            <p><strong>ATTENTION!</strong> Cette action est irréversible et entraînera la perte de toutes les données associées à ce compte.</p>
            <p>Veuillez entrer le mot de passe pour confirmer la suppression du compte</p>
            <form action="" class="form-modal">
                    <div class="form-input-container">
                        <label for="">Mot de passe</label>
                        <input type="password" id="" name="">
                    </div>
                    <div class="btn-modal-container">
                        <button class="btn-modal-action btn-red">ajouter</button>
                        <button class="btn-modal-cancel btn-green">annuler</button>
                    </div>
            </form>
        </dialog>
    <script src="{{ asset('js/modalSupprimer.js') }}"></script>
</main>
@endsection
