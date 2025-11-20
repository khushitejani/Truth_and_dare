<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DareController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TruthController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');



Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');





Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::resource('truth', TruthController::class);
Route::resource('dare', DareController::class);
