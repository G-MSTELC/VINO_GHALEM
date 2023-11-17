@extends('layouts.app')

@section('title', "Liste des rôles")

@section('content')
    <header>
        Liste des rôles
    </header>
    <main>
        <h1>Liste des rôles</h1>
        <div>
            <a href="{{ route('roles.create') }}">Créer un nouveau rôle</a>
            <!-- Tableau affichant la liste des rôles avec leurs informations -->
            <table>
                <thead>
                    <tr>
                        <th>Nom du rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}">Modifier</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
