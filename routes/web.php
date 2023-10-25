<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('/rekamMedis', '\App\Http\Controllers\RekamMedisController')->middleware('auth');

Route::middleware('auth')->prefix('/rekamMedis')->group(function() {
    Route::get('', [RekamMedisController::class, 'index']);
    Route::get('/my', [RekamMedisController::class, 'my']);
    Route::get('/create', [RekamMedisController::class, 'create']);
    Route::post('', [RekamMedisController::class, 'store']);
    Route::get('/{id}', [RekamMedisController::class, 'show']);
    Route::get('/{id}/edit', [RekamMedisController::class, 'edit']);
    Route::patch('/{id}', [RekamMedisController::class, 'update']);
    Route::delete('/{id}', [RekamMedisController::class, 'destroy']);
});

require __DIR__.'/auth.php';
