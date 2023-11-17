<!-- Formulaire de modification des rôles -->
<form action="{{ route('users.update-roles', $user->id) }}" method="post">
    @method('put')
    @csrf

    <div class="container">
        <div class="card">
            <div class="card-header">Modifier <strong>{{ $user->name }}</strong></div>

            <!-- Liste des rôles avec des cases à cocher -->
            @foreach ($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" id="{{ $role->id }}" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                    <label for="{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                </div>
            @endforeach

            <!-- Bouton de soumission du formulaire -->
            <button type="submit" class="btn btn-primary">Modifier les rôles</button>
        </div>
    </div>
</form>
