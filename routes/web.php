<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TruthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    // Bulk import routes
    Route::get('/bulk-import/form', [HomeController::class, 'showForm'])->name('bulk.import.form');
    // Resource truth
    Route::resource('truth', TruthController::class);
    Route::post('/bulk-import/truth', [TruthController::class, 'importTruth'])->name('bulk.import.truth');
    // Resource dare
    Route::resource('dare', DareController::class);
    Route::post('/bulk-import/dare', [DareController::class, 'importDare'])->name('bulk.import.dare');

    Route::fallback(function () {
        return redirect()->route('login');
    });
});

require __DIR__ . '/auth.php';
