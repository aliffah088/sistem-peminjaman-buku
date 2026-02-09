<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| RUTE UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (SATU-SATUNYA)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| RUTE LOGIN WAJIB
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);

    // Pengembalian
    Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])
        ->name('pengembalian.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| KHUSUS ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'cekrole:admin'])->group(function () {
    Route::resource('alat', AlatController::class);
    Route::resource('kategori', KategoriController::class);
});

/*
|--------------------------------------------------------------------------
| DASHBOARD BERDASARKAN ROLE (OPSIONAL)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'cekrole:admin'])->get('/admin/dashboard', fn () => redirect('/dashboard'));
Route::middleware(['auth', 'cekrole:petugas'])->get('/petugas/dashboard', fn () => redirect('/dashboard'));
Route::middleware(['auth', 'cekrole:peminjam'])->get('/peminjam/dashboard', fn () => redirect('/dashboard'));

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

require __DIR__.'/auth.php';
