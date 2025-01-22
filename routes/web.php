<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;

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
    Route::get('/', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::resource('expenses', ExpenseController::class)->except(['show']);
    Route::resource('expenses', ExpenseController::class);
});

Route::resource('expenses', ExpenseController::class)->middleware('auth');

require __DIR__.'/auth.php';
