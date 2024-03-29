<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetController;


//test route
Route::get('/user/{user:id}', [ProfileController::class, 'show']);

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/tweet', [TweetController::class, 'create'])->name('tweet.store');
    Route::patch('/tweet', [TweetController::class, 'update'])->name('tweet.update');
    Route::delete('/tweet', [TweetController::class, 'destroy'])->name('tweet.destroy');

});

require __DIR__.'/auth.php';
