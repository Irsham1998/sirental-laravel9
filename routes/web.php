<?php

use App\Http\Controllers\Auth\OtentikasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// route auth
Route::middleware(['guest'])->group(function () {
    Route::get('/', [OtentikasiController::class, 'login'])->name('login');
    Route::post('/', [OtentikasiController::class, 'loginProcess'])->name('login-proses');
    Route::get('/register', [OtentikasiController::class, 'register'])->name('register');
    Route::post('/register', [OtentikasiController::class, 'registerProcess'])->name('register-proses');
});

Route::post('/logout', [OtentikasiController::class, 'logout'])->name('logout-proses')->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin']);

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth','client']);
