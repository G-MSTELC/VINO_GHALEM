<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BouteilleCellierController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\BouteilleListeController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\Web2scraperController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    // Connexion (redirection)
    Route::get('/', [CustomAuthController::class, 'index'])->name('welcome');
    // Déconnexion
    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

    // Gestion du profil
    Route::get('/profil/{user}', [CustomAuthController::class, 'show'])->name('profil.show');
    Route::get('/profil-modifier/{user}', [CustomAuthController::class, 'edit'])->name('profil.edit');
    Route::put('/profil-modifier/{user}', [CustomAuthController::class, 'update']);
    Route::delete('/profil-modifier/{user}', [CustomAuthController::class, 'destroy'])->name('profil.destroy');

    // Gestion des bouteilles
    Route::get('/bouteilles', [BouteilleController::class, 'index'])->name('bouteille.index');
    Route::get('/bouteilles/{bouteille_id}', [BouteilleController::class, 'show'])->name('bouteille.show');
    Route::get('/bouteilles-ajouter/{bouteille_id}', [BouteilleController::class, 'create'])->name('bouteille.create');
    Route::post('/bouteilles-ajouter', [BouteilleController::class, 'store']);
    Route::get('/bouteilles-modifier/{bouteille_id}', [BouteilleController::class, 'edit'])->name('bouteille.edit');
    Route::put('/bouteilles-modifier/{bouteille_id}', [BouteilleController::class, 'update']);
    Route::delete('/bouteilles-modifier/{bouteille_id}', [BouteilleController::class, 'destroy'])->name('bouteille.destroy');

    // Ajout par ismail
    Route::get('/bouteilles-search', [BouteilleController::class, 'search'])->name('bouteille.search');
    Route::get('/sorting', [BouteilleController::class, 'sorting'])->name('bouteille.sorting');
    Route::get('/filtrer-produits', [BouteilleController::class, 'filtrerProduits'])->name('filtrer_produits');

    // Gestion des celliers
    Route::get('/celliers', [CellierController::class, 'index'])->name('cellier.index');
    Route::get('/celliers-json', [CellierController::class, 'indexJSON']);
    Route::get('/celliers/{cellier_id}/bouteilles', [CellierController::class, 'show'])->name('cellier.show');
    Route::get('/celliers-ajouter', [CellierController::class, 'create'])->name('cellier.create');
    Route::post('/celliers-ajouter', [CellierController::class, 'store']);
    Route::get('/celliers-modifier/{cellier_id}', [CellierController::class, 'edit'])->name('cellier.edit');
    Route::put('/celliers-modifier/{cellier_id}', [CellierController::class, 'update']);
    Route::delete('/celliers-modifier/{cellier_id}', [CellierController::class, 'destroy'])->name('cellier.destroy');

    // Gestion des bouteilles d'un cellier
    Route::post('/celliers-json', [BouteilleCellierController::class, 'store']);
    Route::delete('/celliers/{cellier_id}/bouteilles-celliers-modifier/{bouteille_cellier}', [BouteilleCellierController::class, 'destroy'])->name('bouteilleCellier.delete');
    Route::put('/bouteilles-celliers-modifier/{id}', [BouteilleCellierController::class, 'update']);

    // Gestion des listes
    Route::get('/listes', [ListeController::class, 'index'])->name('liste.index');
    Route::get('/listes-json', [ListeController::class, 'indexJSON']);
    Route::get('/listes/{liste_id}/bouteilles', [ListeController::class, 'show'])->name('liste.show');
    Route::get('/listes-ajouter', [ListeController::class, 'create'])->name('liste.create');
    Route::post('/listes-ajouter', [ListeController::class, 'store']);
    Route::get('/listes-modifier/{liste_id}', [ListeController::class, 'edit'])->name('liste.edit');
    Route::put('/listes-modifier/{liste_id}', [ListeController::class, 'update']);
    Route::delete('/listes-modifier/{liste_id}', [ListeController::class, 'destroy'])->name('liste.destroy');

    // Gestion des bouteilles d'une liste
    Route::post('/listes-json', [BouteilleListeController::class, 'store']);
    Route::delete('/listes/{liste_id}/bouteilles-listes-modifier/{bouteille_liste}', [BouteilleListeController::class, 'destroy'])->name('bouteillListe.delete');
    Route::put('/bouteilles-listes-modifier/{id}', [BouteilleListeController::class, 'update']);
});

// Authentification
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
Route::get('/register', [CustomAuthController::class, 'create'])->name('register');
Route::post('/register', [CustomAuthController::class, 'store'])->name('register.store');

// Admin
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/users-show/{id}', [AdminController::class, 'show'])->name('admin.show-user');
Route::get('/admin/users-create', [AdminController::class, 'create'])->name('admin.create-user');
Route::post('/admin/users-create', [AdminController::class, 'store']);
Route::get('/admin/users-edit/{id}', [AdminController::class, 'edit'])->name('admin.edit-user');
Route::put('/admin/users-edit/{id}', [AdminController::class, 'update']);
Route::delete('/admin/users-delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy-user');

// Routes pour l'administration des utilisateurs
Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [AdminController::class, 'indexUsers'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/', [AdminController::class, 'store'])->name('store');
    Route::get('/{user}', [AdminController::class, 'showUser'])->name('show');
    Route::get('/{user}/edit', [AdminController::class, 'editUser'])->name('edit');
    Route::put('/{user}', [AdminController::class, 'updateUser'])->name('update');
    Route::delete('/{user}', [AdminController::class, 'destroyUser'])->name('destroy');
});

// Routes pour les rôles des utilisateurs
Route::prefix('admin/roles')->name('admin.roles.')->group(function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('index');
    Route::get('/create', [UserRoleController::class, 'create'])->name('create');
    Route::post('/', [UserRoleController::class, 'store'])->name('store');
    Route::get('/{role}/edit', [UserRoleController::class, 'edit'])->name('edit');
    Route::put('/{role}', [UserRoleController::class, 'update'])->name('update');
    Route::delete('/{role}', [UserRoleController::class, 'destroy'])->name('destroy');
});

// Routes pour les permissions des utilisateurs
Route::prefix('admin/permissions')->name('admin.permissions.')->group(function () {
    Route::get('/', [UserPermissionController::class, 'index'])->name('index');
    Route::get('/create', [UserPermissionController::class, 'create'])->name('create');
    Route::post('/', [UserPermissionController::class, 'store'])->name('store');
    Route::get('/{permission}/edit', [UserPermissionController::class, 'edit'])->name('edit');
    Route::put('/{permission}', [UserPermissionController::class, 'update'])->name('update');
    Route::delete('/{permission}', [UserPermissionController::class, 'destroy'])->name('destroy');
});

// Routes pour attribuer/révoquer des rôles et des permissions
Route::put('/admin/user-roles/{user}', [UserRoleController::class, 'updateRoles'])->name('admin.user-roles.updateRoles');
Route::put('/admin/user-permissions/{user}', [UserPermissionController::class, 'updatePermissions'])->name('admin.user-permissions.updatePermissions');

// Utilisation du tableau
Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::delete('/admin/users-delete/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');



// Routes pour le contrôleur de cellier
Route::get('/cellier', [CellierController::class, 'index'])->name('cellier.index');
Route::get('/cellier/recherche', [CellierController::class, 'showSearchForm'])->name('cellier.search-form');
Route::post('/cellier/recherche', [CellierController::class, 'recherche'])->name('cellier.recherche');

// Route pour afficher la vue recherche.blade.php pour un cellier spécifique
Route::get('/celliers/{cellier_id}/recherche', [CellierController::class, 'afficherRechercheCellier'])->name('cellier.recherche.cellier');

// Route pour gérer la recherche dans un cellier spécifique (traitement du formulaire)
Route::post('/celliers/{cellier_id}/recherche', [CellierController::class, 'rechercheCellier'])->name('cellier.recherche.cellier.post');

// Route pour la recherche de bouteilles dans un cellier
Route::post('/celliers/{cellier_id}/recherche-bouteilles', [CellierController::class, 'rechercheBouteilles'])->name('cellier.recherche-bouteilles');

// Routes pour le contrôleur de BouteilleCellier
Route::post('/celliers/recherche/{cellier_id}', [BouteilleCellierController::class, 'rechercheEtFiltrage'])->name('rechercheEtFiltrage.cellier');


// Route de recherche globale
Route::post('/recherche', [CellierController::class, 'recherche'])->name('recherche');

// Afficher le formulaire de recherche dans un cellier
Route::get('/cellier/recherche', [CellierController::class, 'afficherFormulaireRecherche'])->name('cellier.afficher-recherche');
Route::post('/celliers/recherche/{cellier_id}', [BouteilleCellierController::class, 'rechercheEtFiltrage'])->name('rechercheEtFiltrage.cellier');

Route::get('/celliers/recherche/{cellier_id}', [BouteilleCellierController::class, 'rechercheEtFiltrage'])->name('rechercheEtFiltrage.cellier.get');

