<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PeminjamController;

// ADMIN
use App\Http\Controllers\Admin\AlatController;
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

Route::get('/', fn () => view('auth.login'));

Route::get('/login', fn () => view('auth.login'))
    ->name('login')
    ->middleware('guest');

require __DIR__.'/auth.php';

Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin'    => redirect('/admin/dashboard'),
        'petugas'  => redirect('/petugas/dashboard'),
        'peminjam' => redirect('/peminjam/dashboard'),
        default    => abort(403),
    };
})->name('dashboard');

// --- ADMIN ---
Route::middleware(['auth', 'cekrole:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('alat', AlatController::class);
        Route::resource('kategoris', KategoriController::class)->parameters(['kategoris' => 'kategori']);
        Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/{id}', [AdminPeminjamanController::class, 'show'])->name('peminjaman.show');
        Route::patch('/peminjaman/{id}/setujui', [AdminPeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
        Route::patch('/peminjaman/{id}/tolak', [AdminPeminjamanController::class, 'tolak'])->name('peminjaman.tolak');
        Route::resource('users', UserController::class);
        Route::get('/pengembalian', [AdminPengembalianController::class, 'index'])->name('pengembalian.index');

        Route::put('/pengembalian/{id}/denda', [AdminPengembalianController::class, 'updateDenda'])->name('pengembalian.updateDenda');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/log', [LogAktivitasController::class, 'index'])->name('log.index');
    });

// --- PETUGAS ---
Route::middleware(['auth', 'cekrole:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
        Route::resource('peminjaman', PetugasPeminjamanController::class);
        Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])->name('pengembalian.index');
        Route::post('/pengembalian', [PetugasPengembalianController::class, 'store'])->name('pengembalian.store');
        Route::get('/laporan', [PetugasLaporanController::class, 'index'])->name('laporan.index');
    });

// --- PEMINJAM ---
Route::middleware(['auth', 'cekrole:peminjam'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {
        Route::get('/dashboard', [PeminjamController::class, 'dashboard'])->name('dashboard');
        Route::get('/alat', [PeminjamController::class, 'alat'])->name('alat');
        Route::get('/peminjaman', [PeminjamController::class, 'peminjaman'])->name('peminjaman');
        Route::get('/pengembalian', [PeminjamController::class, 'pengembalian'])->name('pengembalian');
        Route::get('/riwayat', [PeminjamController::class, 'riwayat'])->name('riwayat');
        Route::post('/store', [PeminjamController::class, 'store'])->name('store');
    });

// --- GLOBAL ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/check-images', function () {
    $alat = \App\Models\Alat::all(['id', 'nama_alat', 'gambar']);
    return response()->json($alat);
});