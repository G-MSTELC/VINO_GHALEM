@extends('layouts.app')

@section('title', 'Permissions de l\'utilisateur')

@section('content')
<div class="container">
    <h1>Permissions de l'utilisateur</h1>
    <p>Nom de l'utilisateur: {{ $user->nom }} {{ $user->prenom }}</p>

    @include('utilisateur.user-permissions-list') 
    
    <form action="{{ route('user.assignPermission', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="permission">Sélectionnez une permission</label>
            <select name="permission" id="permission" class="form-control">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Attribuer la permission</button>
    </form>
</div>
@endsection
