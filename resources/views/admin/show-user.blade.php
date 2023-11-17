
@extends('layouts.app')

@section('title', 'Détails de l\'utilisateur')

@section('content')
    <div class="container">
        <h1>Détails de l'utilisateur</h1>

        <div class="card">
            <div class="card-header">
                {{ $user->nom }}
            </div>
            <div class="card-body">
                <p><strong>Courriel:</strong> {{ $user->email }}</p>
                <p><strong>Courriel vérifié:</strong> {{ $user->email_verified_at ? 'Oui' : 'Non' }}</p>
                <p><strong>Mot de passe:</strong> {{ $user->password }}</p>
                <p><strong>Date de création:</strong> {{ $user->created_at }}</p>
                <p><strong>Date de modification:</strong> {{ $user->updated_at }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.edit-user', ['id' => $user->id]) }}" class="btn btn-primary">Modifier</a>

            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</button>
        </div>
    </div>

    <!-- Modals de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet utilisateur?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <form action="{{ route('admin.destroy-user', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
