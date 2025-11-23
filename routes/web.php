<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\KolamController;
use App\Http\Controllers\PenggunaanPakanController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PenggunaController;

Route::get('/', function () {
    return redirect()->route('login');
});

// ======= AUTH =======
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ======= PROTECTED ROUTES =======
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pakan
    Route::resource('pakan', PakanController::class);

    // Kolam
    Route::resource('kolam', KolamController::class);
    Route::get('/kolam/{id}/total-pakan', [KolamController::class, 'getTotalPakan'])->name('kolam.totalPakan');

    // Penggunaan Pakan
    Route::resource('penggunaan', PenggunaanPakanController::class);

    // Panen
    Route::resource('panen', PanenController::class);

    // Pengguna (jika ada fitur manajemen user)
    Route::resource('pengguna', PenggunaController::class);

    Route::get('/kolam/{id}/modal-awal', [KolamController::class, 'getModalAwal']);

});
