<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserRoleController extends Controller
{
    // Attribuer un rôle à un utilisateur
    public function assignRole(Request $request, $userId)
    {
        // Vérifier si l'utilisateur existe
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        // Récupérer le nom du rôle depuis le formulaire
        $roleName = $request->input('role');
        
        // Vérifier si le rôle existe
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return redirect()->back()->with('error', 'Rôle non trouvé.');
        }

        // Attribuer le rôle à l'utilisateur
        $user->assignRole($role);

        return redirect()->back()->with('success', 'Rôle attribué avec succès.');
    }

    public function revokeRole(Request $request, $userId)
    {
        // Vérifier si l'utilisateur existe
        $user = User::find($userId);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        // Récupérer le nom du rôle depuis le formulaire
        $roleName = $request->input('role');
        
        // Vérifier si le rôle existe
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return redirect()->back()->with('error', 'Rôle non trouvé.');
        }

        // Révoquer le rôle de l'utilisateur
        $user->removeRole($role);

        return redirect()->back()->with('success', 'Rôle révoqué avec succès.');
    }
}
