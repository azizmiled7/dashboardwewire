<?php

use App\Http\Controllers\MaterielController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/theme', function () {
    return view('theme');
})->name('theme.page');

// Dashboards dynamiques
Route::get('/dashboardadmin', [DashboardController::class, 'admin'])
    ->middleware('auth')->name('dashboardadmin.page');

Route::get('/dashboardtech', [DashboardController::class, 'technicien'])
    ->middleware('auth')->name('dashboardtech.page');

Route::get('/themetech', function () {
    return view('themetech');
})->name('themetech.page');

Route::get('/list-intervention', function () {
    return view('list-intervention');
})->name('list-intervention.page');

// Routes auth protégées
Route::middleware('auth')->group(function () {

    Route::get('/admin/interventions', [InterventionController::class, 'index'])->name('admin.inter');

    Route::get('/affectation', [InterventionController::class, 'affectationAdmin'])->name('affectation');

    Route::get('/technicien/affectation', [UserController::class, 'affectationTechnicien'])->name('technicien.affectation');

    Route::post('/admin/intervention/{id}/affecter', [InterventionController::class, 'affecter'])->name('admin.affecter');

    Route::get('/create', [InterventionController::class, 'create'])->name('interventions.create');
    Route::post('/interventions', [InterventionController::class, 'store'])->name('interventions.store');
    Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions.index');

    // Techniciens
    Route::get('/techniciens', [UserController::class, 'indexTechniciens'])->name('users.techniciens.index');
    Route::get('/techniciens/create', [UserController::class, 'createTechnicien'])->name('users.techniciens.create');
    Route::post('/techniciens', [UserController::class, 'storeTechnicien'])->name('users.techniciens.store');
    Route::get('/techniciens/{id}/edit', [UserController::class, 'editTechnicien'])->name('users.techniciens.edit');
    Route::put('/techniciens/{id}', [UserController::class, 'updateTechnicien'])->name('users.techniciens.update');
    Route::delete('/techniciens/{id}', [UserController::class, 'destroyTechnicien'])->name('users.techniciens.destroy');

    // Matériels
    Route::get('/add-mate', function () { return view('add-mate'); })->name('add-mate.page');
    Route::get('/add-tech', function () { return view('add-tech'); })->name('add-tech.page');

    // Chat / Contact
    Route::get('/contact', [ChatController::class, 'index'])->name('contact');
    Route::post('/contact/send', [ChatController::class, 'send'])->name('contact.send');
    Route::get('/contact/poll', [ChatController::class, 'poll'])->name('contact.poll');
    Route::get('/contact/unread-count', [ChatController::class, 'unreadCount'])->name('contact.unread');
});

Route::resource('materiels', MaterielController::class)->middleware('auth');

require __DIR__.'/auth.php';
