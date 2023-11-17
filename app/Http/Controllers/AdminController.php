<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function indexUsers()
    {
        $users = User::with('roles', 'permissions')->get();
        return view('admin.index-users', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.create-user');
    }

    public function store(Request $request)
    {
        try {
            $this->validateUser($request);

            $user = new User;
            $this->fillUserData($user, $request);
            $user->save();

            return redirect(route('admin.index-users'))->withSuccess('Nouvel utilisateur enregistré');
        } catch (\Exception $e) {
            return redirect(route('admin.create-user'))->withErrors(["Erreur d'enregistrement"]);
        }
    }

    public function showUser($id)
    {
        $user = User::with('roles', 'permissions')->findOrFail($id);
        return view('admin.show-user', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();

        $user->load('roles', 'permissions');

        return view('admin.edit-user', compact('user', 'roles', 'permissions'));
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $this->validateUser($request);

            $user = User::findOrFail($id);
            $this->fillUserData($user, $request);
            $user->save();

            $roles = $request->input('roles', []);
            $user->syncRoles($roles);

            $permissions = $request->input('permissions', []);
            $user->syncPermissions($permissions);

            return redirect(route('admin.index-users'))->withSuccess('Utilisateur mis à jour');
        } catch (\Exception $e) {
            return redirect(route('admin.edit-user', $id))->withErrors(["Erreur de mise à jour"]);
        }
    }

    public function destroyUser(User $user)
{
    $user->delete();
    return redirect(route('admin.index-users'))->withSuccess('Utilisateur supprimé');
}

    private function validateUser(Request $request)
    {
        $request->validate([
            'nom'      => 'required|min:2|max:20|alpha',
            'email'    => 'required|email',
            'new_email' => 'sometimes|email',
            'password' => 'nullable|min:6',
        ]);
    }

    private function fillUserData(User $user, Request $request)
    {
        $user->nom = $request->input('nom');
        $user->email = $request->filled('new_email') ? $request->input('new_email') : $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    }
}
