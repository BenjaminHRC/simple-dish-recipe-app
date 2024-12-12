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
    
    Route::resource('dishes', DishController::class)
        ->except(['index'])
        ->middleware('can:manage,dish');
});
// @TODO pas de rôle mais passer par les policies
// @TODO tu passe la gate en middleware ('can:view,dish')
Route::middleware(['auth', 'role:ADMIN'])->group(function () {
    Route::post('/', [DishController::class, 'store'])->name('dish.store');
    Route::get('/edit/{dish}', [DishController::class, 'edit'])->name('dish.edit');
    Route::get('/create', [DishController::class, 'create'])->name('dish.create');
    Route::post('/update/{dish}', [DishController::class, 'update'])->name('dish.update');
    //@TODO: Route::delete ici
    Route::get('/delete/{dish}', [DishController::class, 'destroy'])->name('dish.destroy');
});

Route::prefix("/profile")->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
