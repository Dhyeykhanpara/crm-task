<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    return view('welcome');
});

// require auth routes if you created routes/auth.php (or ensure auth routes exist)
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::resource('customers', CustomerController::class);
    Route::resource('conversations', ConversationController::class)->only(['index','create','store']);
    Route::get('messages/send', [MessageController::class,'showForm'])->name('messages.form');
    Route::post('messages/send', [MessageController::class,'send'])->name('messages.send');
});
