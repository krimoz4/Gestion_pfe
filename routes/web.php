<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\SoutenanceController;



// --- 1. ROUTES PUBLIQUES (Connexion) ---
Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- 2. ROUTES PROTÉGÉES (Nécessitent d'être connecté) ---
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $stats = [];
        if (Auth::user()->role === 'admin') {
            $stats = [
                'etudiants' => \App\Models\Etudiant::count(),
                'profs' => \App\Models\Professeur::count(),
                'stages' => \App\Models\Stage::count(),
                'valid' => \App\Models\Stage::where('statut', 'valide')->count(),
            ];
        }
        return view('dashboard', compact('stats'));
    })->name('dashboard');


    // --- ROUTES PARTAGÉES (ADMIN + PROF) ---
    Route::get('/stage/{id}/notation', [StageController::class, 'notation'])->name('stages.notation');
    Route::post('/stage/{id}/notation', [StageController::class, 'storeNote'])->name('stages.storeNote');
    Route::get('/stage-details/{id}', [StageController::class, 'show'])->name('stages.show_public');


    // --- ZONE ADMIN (Accès Total) ---
    Route::middleware('role:admin')->group(function () {
        Route::resource('etudiants', EtudiantController::class);
        Route::resource('professeurs', ProfesseurController::class);
        Route::resource('stages', StageController::class);
        Route::resource('soutenances', SoutenanceController::class);
    });


    // --- ZONE PROFESSEUR ---
    Route::middleware('role:prof')->group(function () {
        Route::get('/mes-stages', [StageController::class, 'index'])->name('profs.stages');
    });


    // --- ZONE ÉTUDIANT ---
    Route::middleware('role:etudiant')->group(function () {
        Route::get('/mon-espace', [StageController::class, 'monEspace'])->name('etudiant.dashboard');
        Route::post('/stage/{id}/upload', [StageController::class, 'uploadRapport'])->name('stages.upload');
    });

});