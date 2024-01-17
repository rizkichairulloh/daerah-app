<?php

use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\Excel\ExportExcelDaerahController;
use App\Http\Controllers\Excel\ExportExcelKelompokController;
use App\Http\Controllers\Excel\ImportExcelDaerahController;
use App\Http\Controllers\Excel\ImportExcelDesaController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\Pdf\ExportPdfDaerahConttroller;
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
Route::get('/exportpdfdaerah', ExportPdfDaerahConttroller::class)->name('exportpdfdaerah')->middleware(['auth', 'verified']);
Route::get('/export-excel-kelompok', ExportExcelKelompokController::class)->name('export-excel-kelompok')->middleware(['auth', 'verified']);
Route::get('/export-excel-daerah', ExportExcelDaerahController::class)->name('export-excel-daerah')->middleware(['auth', 'verified']);
Route::post('/import-excel-desa', ImportExcelDesaController::class)->name('import-excel-desa')->middleware(['auth', 'verified']);
Route::post('/import-excel-daerah', ImportExcelDaerahController::class)->name('import-excel-daerah')->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
