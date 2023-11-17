<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
       
        $users = User::all();
    
        return view('admin.users.index', compact('users'));
    }
    


    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom'   => 'required|min:2|max:20|alpha',
            'email' => 'required|email',
        ]);

        $user->update([
            'nom'   => $request->input('nom'),
            'email' => $request->input('email'),
        ]);

        
        if ($request->has('roles')) {
            $user->syncRoles($request->input('roles'));
        }

        if ($request->has('permissions')) {
            $user->syncPermissions($request->input('permissions'));
        }

        return redirect(route('admin.users.index'))->withSuccess('Utilisateur mis à jour');
    }
}
