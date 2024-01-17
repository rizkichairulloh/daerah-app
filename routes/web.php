<?php

use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\Pdf\ExportPdfDesaConttroller;
use App\Http\Controllers\Pdf\ExportPdfKelompokConttroller;
use App\Http\Controllers\ProfileController;
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

Route::resource('/desa', DesaController::class)->middleware(['auth', 'verified']);
Route::resource('/kelompok', KelompokController::class)->middleware(['auth', 'verified']);
Route::resource('/daerah', DaerahController::class)->middleware(['auth', 'verified']);

Route::get('/exportpdfkelompok', ExportPdfKelompokConttroller::class)->name('exportpdfkelompok')->middleware(['auth', 'verified']);
Route::get('/exportpdfdesa', ExportPdfDesaConttroller::class)->name('exportpdfdesa')->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
 