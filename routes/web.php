<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BouteilleCellierController;
use App\Http\Controllers\BouteilleListeController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\Web2scraperController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ListeController;


// Route d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () {
    Route::post('/cellier', 'CellierController@store')->name('cellier.store');
    // *************** Connexion (redirection) ****************
    Route::get('/', [CustomAuthController::class, 'index'])->name('welcome');

    // *************** Déconnexion ****************
    Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');

    // *************** Gestion du profil ****************
    // Affichage du profil de l'utilisateur
    Route::get('/profil/{user}', [CustomAuthController::class, 'show'])->name('profil.show');
    // Modification du profil de l'utilisateur
    Route::get('/profil-modifier/{user}', [CustomAuthController::class, 'edit'])->name('profil.edit');
    // Stockage de la modification du profil de l'utilisateur
    Route::put('/profil-modifier/{user}', [CustomAuthController::class, 'update']);
    // Suppression d'un profil
    Route::delete('/profil-modifier/{user}', [CustomAuthController::class, 'destroy'])->name('profil.destroy');

    // *************** Gestion des bouteilles ****************

    // Importer data de la SAQ
    Route::get('/scrape', [Web2scraperController::class, 'scrapeData']);
    // Affichage de toutes les bouteilles
    Route::get('/bouteilles', [BouteilleController::class, 'index'])->name('bouteille.index');
    // Affichage des informations d'une bouteille 
    Route::get('/bouteilles/{bouteille_id}', [BouteilleController::class, 'show'])->name('bouteille.show');
    // Création d'une bouteille personnalisée
    Route::get('/bouteilles-ajouter/{bouteille_id}', [BouteilleController::class, 'create'])->name('bouteille.create');
    // Stockage d'une bouteille personnalisée dans la BDD
    Route::post('/bouteilles-ajouter', [BouteilleController::class, 'store']);
    // Modification d'une bouteille personnalisée 
    Route::get('/bouteilles-modifier/{bouteille_id}', [BouteilleController::class, 'edit'])->name('bouteille.edit');
    // Stockage de la modification d'une bouteille personnalisée dans la BDD
    Route::put('/bouteilles-modifier/{bouteille_id}', [BouteilleController::class, 'update']);
    // Suppression d'une bouteille personnalisée
    Route::delete('/bouteilles-modifier/{bouteille_id}', [BouteilleController::class, 'destroy'])->name('bouteille.destroy');

    //Ajout par ismail
    //affichage de toutes les bouteilles de la SAQ
    Route::get('/bouteilles', [BouteilleController::class, 'index'])->name('bouteille.index');
    // Recheche par mot clé dans le titre
    Route::get('/bouteilles-search', [BouteilleController::class, 'search'])->name('bouteille.search');
   //tri
   Route::get('/sorting', [BouteilleController::class, 'sorting'])->name('bouteille.sorting');
    //filtre
   Route::get('/filtrer-produits', [BouteilleController::class, 'filtrerProduits'])->name('filtrer_produits');  

    // *************** Gestion des celliers ****************

    // Affichage de tous les celliers
    Route::get('/celliers', [CellierController::class, 'index'])->name('cellier.index'); 
    // Affichage de tous les celliers en JSON
    Route::get('/celliers-json', [CellierController::class, 'indexJSON']); 
    // Affichage d'un cellier et de ses bouteilles
    Route::get('/celliers/{cellier_id}/bouteilles', [CellierController::class, 'show'])->name('cellier.show');
    // Création d'un cellier
    Route::get('/celliers-ajouter', [CellierController::class, 'create'])->name('cellier.create');
    // Stockage d'un cellier dans la BDD
    Route::post('/celliers-ajouter', [CellierController::class, 'store']);
    // Modification d'un cellier 
    Route::get('/celliers-modifier/{cellier_id}', [CellierController::class, 'edit'])->name('cellier.edit');
    // Stockage de la modification d'un cellier dans la BDD
    Route::put('/celliers-modifier/{cellier_id}', [CellierController::class, 'update']);
    // Suppression d'un cellier
    Route::delete('/celliers-modifier/{cellier_id}', [CellierController::class, 'destroy'])->name('cellier.destroy');

    // *************** Gestion des bouteilles d'un cellier ****************

    // Ajout d'une bouteille à un cellier
    Route::post('/celliers-json', [BouteilleCellierController::class, 'store']);
    // Retrait d'une bouteille d'un cellier
    Route::delete('/celliers/{cellier_id}/bouteilles-celliers-modifier/{bouteille_cellier}', [BouteilleCellierController::class, 'destroy'])->name('bouteilleCellier.delete');
    // Modification de la quantité de bouteilles se trouvant dans un même cellier
    Route::put('/bouteilles-celliers-modifier/{id}', [BouteilleCellierController::class, 'update']);

    // *************** Gestion des listes ****************

    // Affichage de toutes les listes
    Route::get('/listes', [ListeController::class, 'index'])->name('liste.index'); 
    // Affichage de tous les celliers en JSON
    Route::get('/listes-json', [ListeController::class, 'indexJSON']); 
    // Affichage d'une liste et de ses bouteilles
    Route::get('/listes/{liste_id}/bouteilles', [ListeController::class, 'show'])->name('liste.show');
    // Création d'une liste
    Route::get('/listes-ajouter', [ListeController::class, 'create'])->name('liste.create');
    // Stockage d'une liste dans la BDD
    Route::post('/listes-ajouter', [ListeController::class, 'store']);
    // Modification d'une liste 
    Route::get('/listes-modifier/{liste_id}', [ListeController::class, 'edit'])->name('liste.edit');
    // Stockage de la modification d'une liste dans la BDD
    Route::put('/listes-modifier/{liste_id}', [ListeController::class, 'update']);
    // Suppression d'une liste
    Route::delete('/listes-modifier/{liste_id}', [ListeController::class, 'destroy'])->name('liste.destroy');

    // *************** Gestion des bouteilles d'une liste ****************

    // Ajout d'une bouteille à une liste
    Route::post('/listes-json', [BouteilleListeController::class, 'store']);
    // Retrait d'une bouteille d'une liste
    Route::delete('/listes/{liste_id}/bouteilles-listes-modifier/{bouteille_liste}', [BouteilleListeController::class, 'destroy'])->name('bouteillListe.delete');
    // Modification de la quantité de bouteilles se trouvant dans une même liste
    Route::put('/bouteilles-listes-modifier/{id}', [BouteilleListeController::class, 'update']);

});

// *************** Authentification ****************

// Page de connexion
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
// Connexion
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
// Création d'un nouvel utilisateur
Route::get('/register', [CustomAuthController::class, 'create'])->name('register');
// Stockage d'un nouvel utilisateur dans la BDD
Route::post('/register', [CustomAuthController::class, 'store'])->name('register.store');



// Affichage de tous les utilisateurs
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.index');
// Affichage d'un utilisateur
Route::get('/admin/users-show/{id}', [AdminController::class, 'show'])->name('admin.show-user');
// Création d'un nouvel utilisateur
Route::get('/admin/users-create', [AdminController::class, 'create'])->name('admin.create-user');
// Stockage d'un nouvel utilisateur dans la BDD
Route::post('/admin/users-create', [AdminController::class, 'store']);
// Modification d'un utilisateur
Route::get('/admin/users-edit/{id}', [AdminController::class, 'edit'])->name('admin.edit-user');
// Stockage de la modification d'un utilisateur dans la BDD
Route::put('/admin/users-edit/{id}', [AdminController::class, 'update']);
// Suppression d'un utilisateur
Route::delete('/admin/users-delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy-user');




//Route::get('/bouteilles', [BouteilleController::class, 'index'])->name('bouteille.index');
// Recheche par mot clé dans le titre
//Route::get('/bouteilles-search', [BouteilleController::class, 'search'])->name('bouteille.search');  
//Route::get('/bouteilles/{bouteille_id}', [BouteilleController::class, 'show'])->name('bouteille.show');

//tri
//Route::get('/sorting', [BouteilleController::class, 'sorting'])->name('bouteille.sorting');
//filtre
//Route::get('/filtrer-produits', [BouteilleController::class, 'filtrerProduits'])->name('filtrer_produits');

//Route::get('/scrape', [Web2scraperController::class, 'scrapeData']);



// Routes pour les utilisateurs
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

Route::get('/bouteille/{cellier_id}', [BouteilleCellierController::class, 'index'])
    ->name('bouteille.cellier.index');

// Utilisation du  contrôleur standard pour l'index des bouteilles
Route::get('/bouteille', [BouteilleController::class, 'index'])->name('bouteille.index');


// Affichage du formulaire de recherche
Route::get('/cellier/{cellier_id}/recherche', [CellierController::class, 'showRechercheForm'])
    ->name('recherche.form');

// Soumission du formulaire de recherche et affichage des résultats
Route::post('/cellier/{cellier_id}/recherche-et-filtrage', [CellierController::class, 'rechercheEtFiltrage'])
    ->name('rechercheEtFiltrage.cellier');

   
    Route::post('/cellier/{cellier_id}/recherche', [CellierController::class, 'rechercheEtFiltrage'])->name('rechercheEtFiltrage.cellier');
    Route::post('/cellier/{cellier_id}/recherche', [BouteilleCellierController::class, 'rechercheEtFiltrage'])->name('rechercheEtFiltrage.cellier');

    Route::post('/cellier/{cellier_id}/recherche', 'BouteilleCellierController@rechercheEtFiltrage')->name('rechercheEtFiltrage.cellier');

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


// Affichage de l'index des bouteilles d'un cellier spécifique
Route::get('/bouteille/{cellier_id}', [BouteilleCellierController::class, 'index'])
    ->name('bouteille.cellier.index');

// Affichage de l'index des bouteilles (contrôleur standard)
Route::get('/bouteille', [BouteilleController::class, 'index'])->name('bouteille.index');

// Affichage du formulaire de recherche dans un cellier
Route::get('/cellier/{cellier_id}/recherche', [CellierController::class, 'showRechercheForm'])
    ->name('recherche.form');

// Soumission du formulaire de recherche et affichage des résultats dans un cellier
Route::post('/cellier/{cellier_id}/recherche-et-filtrage', [CellierController::class, 'rechercheEtFiltrage'])
    ->name('rechercheEtFiltrage.cellier');

// Recherche et filtrage des bouteilles dans un cellier
Route::post('/cellier/{cellier_id}/recherche-bouteilles', [CellierController::class, 'rechercheBouteilles'])
    ->name('cellier.recherche-bouteilles');

// Recherche globale
Route::post('/recherche', [CellierController::class, 'recherche'])->name('recherche');

// Affichage du formulaire de recherche dans un cellier
Route::get('/cellier/recherche', [CellierController::class, 'afficherFormulaireRecherche'])
    ->name('cellier.afficher-recherche');

// Recherche et filtrage des bouteilles dans un cellier (post)
Route::post('/cellier/{cellier_id}/recherche', [BouteilleCellierController::class, 'rechercheEtFiltrage'])
    ->name('rechercheEtFiltrage.cellier.post');

// Recherche et filtrage des bouteilles dans un cellier (get)
Route::get('/cellier/{cellier_id}/recherche', [BouteilleCellierController::class, 'rechercheEtFiltrage'])
    ->name('rechercheEtFiltrage.cellier.get');


Route::get('/celliers/{cellier_id}/recherche-bouteilles', [CellierController::class, 'rechercheBouteilles'])
    ->name('cellier.recherche-bouteilles.get');


Route::get('/recherche', [CellierController::class, 'afficherFormulaireRecherche'])
    ->name('recherche.get');


// Route pour traiter le formulaire de création de cellier
Route::post('/cellier/store', [CellierController::class, 'store'])->name('cellier.store');
Route::get('/cellier/recherche', [CellierController::class, 'afficherFormulaireRecherche'])
    ->name('cellier.recherche');
Route::get('/cellier/create', [CellierController::class, 'create'])->name('cellier.create');
   
