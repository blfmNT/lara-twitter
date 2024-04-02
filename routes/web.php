<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;


Route::get('/', [HomeController::class, 'index'])
    //->middleware(['auth', 'verified'])
    ->middleware('auth')
    ->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile/{user:id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/covers', [ProfileController::class, 'updateCovers'])->name('profile.covers');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tweet/{tweet:id}', [TweetController::class, 'show'])->name('tweet.show');
    Route::post('/tweet', [TweetController::class, 'create'])->name('tweet.store');
    Route::patch('/tweet', [TweetController::class, 'update'])->name('tweet.update');
    Route::delete('/tweet/{tweet:id}', [TweetController::class, 'destroy'])->name('tweet.destroy');


    Route::post('/like', [LikeController::class, 'store'])->name('like.toggle');

});

require __DIR__.'/auth.php';
