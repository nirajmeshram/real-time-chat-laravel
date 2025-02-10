<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Events\TestEvent;


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
    Route::get('/chats', [MessageController::class, 'index'])->name('all-chats');
    Route::post('/store-message', [MessageController::class, 'saveMessage'])->name('store-message');
});

require __DIR__ . '/auth.php';

Route::get('/test', function () {
    // event(new \App\Events\TestEvent());
    broadcast(new TestEvent());

    return 'Broadcast sent!';
});
