<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

// --- Tambahan Controller Agrovia ---
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\PekerjaController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE UNTUK YANG SUDAH LOGIN (AUTH) ---
Route::group(['middleware' => 'auth'], function () {

    // 1. Rute Dashboard (Ganti view bawaan dengan Controller Agrovia)
    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Rute CRUD Agrovia
    Route::resource('lahan', LahanController::class);
    Route::resource('pekerja', PekerjaController::class);
    Route::resource('panen', PanenController::class);
    Route::resource('kegiatan', KegiatanController::class);

    // 3. Rute Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/produksi', [LaporanController::class, 'produksi'])->name('laporan.produksi');

    // --- INI YANG TADI HILANG ---
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    // 4. Rute Profil & Logout (Bawaan Template)
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::match(['get', 'post'], '/logout', [SessionsController::class, 'destroy'])->name('logout');
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
});


// --- RUTE UNTUK YANG BELUM LOGIN (GUEST) ---
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);

    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/intro', function () {
    return view('intro');
});
