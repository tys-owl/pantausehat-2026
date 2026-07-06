<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HistoryController;
use App\Livewire\WaterCalculator;
use App\Livewire\SleepCalculator;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kalkulator/air', WaterCalculator::class)->name('water.calculator');
    Route::get('/kalkulator/tidur', SleepCalculator::class)->name('sleep.calculator');

    Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/artikel/{article}', [ArticleController::class, 'show'])->name('articles.show');

    Route::get('/histori', [HistoryController::class, 'index'])->name('history.index');
});

require __DIR__.'/auth.php';