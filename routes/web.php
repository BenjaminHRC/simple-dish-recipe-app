<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DishController::class, 'index'])->name('home');
    Route::get('/favorites', [DishController::class, 'favorites'])->name('dish.favorites');
    Route::post('/favorite/{dish}', [DishController::class, 'addFavorite'])->name('dish.add.favorite');
    
    Route::resource('dishes', DishController::class);
        // ->middleware('can:manage,dish');
});
// @TODO pas de rôle mais passer par les policies
// @TODO tu passe la gate en middleware ('can:view,dish')

Route::prefix("/profile")->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
