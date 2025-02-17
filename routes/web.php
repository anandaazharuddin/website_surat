<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratUserController;

    Route::get('/', function () {
        return view('welcome');
    });

//HALAMANLOGIN
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login')->middleware('guest');
//PROSESLOGIN
    Route::post('/login', [LoginController::class, 'login']);
//LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Dashboard (hanya bisa diakses setelah login)
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
    
    Route::get('/surat/masuk', [SuratUserController::class, 'suratMasuk']);
    Route::get('/surat/keluar', [SuratUserController::class, 'suratKeluar'])->name('surat.keluar');
//SURAT
    Route::resource('surat', SuratController::class);

//REGISTER
    Route::middleware('guest')->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
    });





//DOWNLOAD SURAT 
Route::get('/surat/download/{id}', [SuratController::class, 'downloadWord'])->name('surat.download');
//surat 
Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');

require __DIR__.'/auth.php';
