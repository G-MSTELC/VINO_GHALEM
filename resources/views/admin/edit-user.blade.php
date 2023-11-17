@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Modifier l'utilisateur : {{ $user->nom }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control" value="{{ $user->nom }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Actuel</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="new_email">Nouvel Email</label>
                                <input type="email" name="new_email" id="new_email" class="form-control" value="{{ $user->email }}" required>
                            </div>


                            <div class="form-group">
                                <label>Rôles</label>
                                @if(isset($roles) && count($roles) > 0)
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="roles[]"
                                                value="{{ $role->id }}"
                                                class="form-check-input"
                                                id="{{ $role->id }}"
                                                {{ $user->roles->contains($role) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Aucun rôle disponible</p>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Autorisations</label>
                                @if(isset($permissions) && count($permissions) > 0)
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                class="form-check-input"
                                                {{ $user->permissions->contains($permission) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Aucune autorisation disponible</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
                        </form>

                        <!-- Formulaire de suppression -->
                        <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Supprimer</button>
                        </form>

                        <!-- Rôles attribués et Autorisations accordées -->
                        <p>Rôles attribués : {{ implode(', ', $user->roles->pluck('name')->toArray()) }}</p>
                        <p>Autorisations accordées : {{ implode(', ', $user->permissions->pluck('name')->toArray()) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
