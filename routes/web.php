<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;

Route::middleware(['auth'])->group(function () {
     Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('tasks', TaskController::class);
    Route::resource('teams', TeamController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('teams/{team}/users', [TeamController::class, 'showUsers'])->name('teams.users');
    Route::post('/teams/{team}/invite', [TeamController::class, 'inviteUsers'])->name('teams.invite');

    Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::resource('comments', CommentController::class)->only([
    'update', 'destroy', 'edit'
]);

});



// Routes d'authentification Breeze
require __DIR__.'/auth.php';
