<ul>
    @foreach($user->getRoleNames() as $role)
        <li>{{ $role }}</li>
    @endforeach
</ul>
