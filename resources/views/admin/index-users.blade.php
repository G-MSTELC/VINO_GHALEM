<!-- admin/index-user.blade.php -->

@extends('layouts.app')

@section("title", "Liste d'utilisateurs")

@section('content')
    <header>
        utilisateurs
    </header>
    <main>
        <div class="btn-submit">
            <a href="{{ route('admin.create-user') }}">ajouter un utilisateur</a>
        </div>
        <div class="form-container">
            <form action="">
                <div class="form-input-container">
                    <label for="search_users">RECHERCHE</label>
                    <input type="text" id="search_users">
                </div>
            </form>
        </div>
        <div class="admin-table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>ACTION</th>
                        <th>SUPPRIMER</th>
                        <th>PROFIL</th>
                        <th>ROLE</th>
                        <th>AUTORISATION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">
                                    <button class="btn-ajouter">Mettre à jour</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.show', ['user' => $user->id]) }}">
                                    Voir le profil
                                </a>
                            </td>
                            <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                            <td>{{ implode(', ', $user->permissions->pluck('name')->toArray()) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Aucun utilisateur</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection
