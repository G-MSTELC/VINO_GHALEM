<ul>
    @foreach($user->getPermissionNames() as $permission)
        <li>{{ $permission }}</li>
    @endforeach
</ul>
