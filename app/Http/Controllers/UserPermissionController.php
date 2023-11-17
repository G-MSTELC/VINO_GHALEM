<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserPermissionController extends Controller
{
    // Afficher la page pour attribuer une permission à un utilisateur
    public function showAssignPermissionForm($userId)
    {
        $user = User::find($userId);
        $permissions = Permission::all();

        return view('admin.users.assign-permission', compact('user', 'permissions'));
    }

    // Attribuer une permission à un utilisateur
    public function assignPermission(Request $request, $userId)
    {
        $user = User::find($userId);

        $permissionName = $request->input('permission');
        $permission = Permission::where('name', $permissionName)->first();

        $user->givePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission attribuée avec succès.');
    }

    // Révoquer une permission d'un utilisateur
    public function revokePermission(Request $request, $userId)
    {
        $user = User::find($userId);

        $permissionName = $request->input('permission');
        $permission = Permission::where('name', $permissionName)->first();

        $user->revokePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission révoquée avec succès.');
    }
}
