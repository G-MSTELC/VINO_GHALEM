@extends('layouts.app')

@section('title', 'Rôles de l\'utilisateur')

@section('content')
<div class="container">
    <h1>Rôles de l'utilisateur</h1>
    <p>Nom de l'utilisateur: {{ $user->nom }} {{ $user->prenom }}</p>

    @include('utilisateur.user-roles-list') 
    
    <form action="{{ route('user.assignRole', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="role">Sélectionnez un rôle</label>
            <select name="role" id="role" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Attribuer le rôle</button>
    </form>
</div>
@endsection
