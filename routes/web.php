<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PeminjamController;

// ADMIN
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\Admin\AdminPengembalianController;
use App\Http\Controllers\Admin\AdminPeminjamanController;

// PETUGAS
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\LaporanController as PetugasLaporanController;

/*
|--------------------------------------------------------------------------
| HOME / LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function () {

    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($role === 'petugas') {
        return redirect()->route('petugas.dashboard');
    }

    if ($role === 'peminjam') {
        return redirect()->route('peminjam.dashboard');
    }

    Auth::logout();
    abort(403);

})->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'cekrole:admin'])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('alat', AlatController::class);
    Route::resource('kategoris', KategoriController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('users', UserController::class);

    Route::get('/peminjaman-monitoring', [AdminPeminjamanController::class, 'index'])
        ->name('peminjaman.monitoring');

    Route::get('/pengembalian', [AdminPengembalianController::class, 'index'])
        ->name('pengembalian.index');

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    // ✅ FIX ERROR INI (LOG ACTIVITY)
    Route::get('/log', [LogAktivitasController::class, 'index'])
        ->name('log.index');
});

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'cekrole:petugas'])
->prefix('petugas')
->name('petugas.')
->group(function () {

    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('peminjaman', PetugasPeminjamanController::class);

    Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])
        ->name('pengembalian.index');

    Route::post('/pengembalian', [PetugasPengembalianController::class, 'store'])
        ->name('pengembalian.store');

    Route::get('/laporan', [PetugasLaporanController::class, 'index'])
        ->name('laporan.index');
});

/*
|--------------------------------------------------------------------------
| PEMINJAM
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'cekrole:peminjam'])->group(function () {

    Route::get('/peminjam/dashboard', [PeminjamController::class, 'dashboard'])
        ->name('peminjam.dashboard');

    Route::get('/peminjam/alat', [PeminjamController::class, 'alat'])
        ->name('peminjam.alat');

    Route::get('/peminjam/peminjaman', [PeminjamController::class, 'peminjaman'])
        ->name('peminjam.peminjaman');

    Route::get('/peminjam/riwayat', [PeminjamController::class, 'riwayat'])
        ->name('peminjam.riwayat');

    Route::post('/peminjam/store', [PeminjamController::class, 'store'])
        ->name('peminjam.store');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])
        ->name('pengembalian.update');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');