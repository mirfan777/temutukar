<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemuTukarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});


Route::get('/temutukar', [TemuTukarController::class, 'index'])->name('temu-tukar.index');
Route::get('/temutukar/filter-category', [TemuTukarController::class, 'filterByCategory']);
Route::get('/temutukar/filter-distance', [TemuTukarController::class, 'filterByDistance']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
