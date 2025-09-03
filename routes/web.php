<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SidatDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FishingDataImportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/data/{sidat}', [SidatDataController::class, 'showPublic'])->name('sidat.public.show');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('admin.users.updateRole');
    // untuk langsung ambil dari E:\filipin.csv
    Route::get('/upload-fishing', [FishingDataImportController::class, 'importForm'])->name('sidat.import');
    Route::post('/upload-fishing', [FishingDataImportController::class, 'upload'])->name('fishing.upload');
    // kalau mau via form upload
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sidat/export', [SidatDataController::class, 'export'])->name('sidat.export');

    Route::resource('sidat', SidatDataController::class);

    Route::get('/get-provinces/{country}', [DashboardController::class, 'getProvinces']);
});

require __DIR__ . '/auth.php';