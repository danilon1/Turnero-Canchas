<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FutbolController;
use App\Http\Controllers\BasquetController;
use App\Http\Controllers\VoleyController;
use App\Http\Controllers\PadelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/futbol', [FutbolController::class, 'futbol'])->name('futbol');
Route::get('/basquet', [BasquetController::class, 'basquet'])->name('basquet');
Route::get('/voley', [VoleyController::class, 'voley'])->name('voley');
Route::get('/padel', [PadelController::class, 'padel'])->name('padel');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
