<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StreamerDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupporterDashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Landing Page (menampilkan welcome.blade.php)
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard Streamer (menampilkan resources/views/streamer/dashboard.blade.php)
Route::prefix('dashboard')->group(function () {    
   Route::get('/settings', [StreamerDashboardController::class, 'settings'])->name('streamer.settings'); 
   Route::post('/settings', [StreamerDashboardController::class, 'updateSettings']);
    Route::get('/setup', function () {
    return view('streamer.setup');
});
Route::post('/setup', [StreamerDashboardController::class, 'processSetup']);
    Route::get('/', [StreamerDashboardController::class, 'index'])->name('streamer.dashboard');
    Route::post('/bounty/{id}/claim', [StreamerDashboardController::class, 'claimBounty'])->name('bounty.claim');
    Route::get('/squads', [StreamerDashboardController::class, 'manageSquads'])->name('squad.index');
});

Route::get('/register', function (Illuminate\Http\Request $request) {
    // Menangkap parameter '?role=streamer' dari URL
    $role = $request->query('role', 'streamer'); 
    return view('auth.register', compact('role'));
});
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk menampilkan form login
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses data login
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

// Rute untuk logout
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::prefix('supporter')->group(function () {
    Route::get('/', [SupporterDashboardController::class, 'index'])->name('supporter.dashboard');
});