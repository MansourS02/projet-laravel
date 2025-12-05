<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

// Routes protégées par auth + verified
Route::middleware(['auth', 'verified'])->group(function () {

    // Redirection de la racine vers la liste des produits
    Route::get('/', function () {
        return redirect()->route('produits.index');
    })->name('dashboard');
      Route::get('dashboard', function () {
        return redirect()->route('dashboard');
    })->name('dashboard');
    // Toutes les routes CRUD pour les produits
    Route::resource('produits', ProduitController::class);

    // Routes pour la gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes d'auth (login, register, etc.)
require __DIR__.'/auth.php';
