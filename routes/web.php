<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\MealController;
use App\Http\Controllers\CostController;




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
});

Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
Route::post('/meals/store', [MealController::class, 'store'])->name('meals.store');
Route::get('/meals/monthly-total', [MealController::class, 'monthlyTotal'])->name('meals.monthly-total');


Route::get('/cost', [CostController::class, 'index'])->name('cost.index');
Route::post('/cost/store', [CostController::class, 'store'])->name('cost.store');
Route::get('/cost/monthly-total', [CostController::class, 'monthlyTotal'])->name('cost.monthly-total');



require __DIR__.'/auth.php';
