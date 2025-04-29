<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemuTukarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('landing');
});

Route::get('/chat', function () {
    return view('pages.chat.chat');
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

    // chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages', [ChatController::class, 'fetchMessages'])->name('chat.fetch');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::delete('/chat/delete/{message}', [ChatController::class, 'deleteMessage'])->name('chat.delete');
    Route::post('/chat/typing', [ChatController::class, 'typing'])->name('chat.typing');
});

require __DIR__.'/auth.php';
