<?php

use App\Http\Controllers\Auth\OtentikasiController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentlogController;
use App\Http\Controllers\UserController;
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
// route guest
Route::middleware(['guest'])->group(function () {
    Route::get('/', [OtentikasiController::class, 'login'])->name('login');
    Route::post('/', [OtentikasiController::class, 'loginProcess'])->name('login-proses');
    Route::get('/register', [OtentikasiController::class, 'register'])->name('register');
    Route::post('/register', [OtentikasiController::class, 'registerProcess'])->name('register-proses');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin']);

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth','client']);


Route::middleware(['auth'])->group(function () {
    // logout end session
    Route::post('/logout', [OtentikasiController::class, 'logout'])->name('logout-proses');

    Route::get('/books', [BookController::class, 'index'])->name('books');

    // admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories')->middleware('admin');
    Route::post('/categories-add', [CategoryController::class, 'store'])->name('categories-add')->middleware('admin');

    Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('admin');
    Route::get('/rent-logs', [RentlogController::class, 'index'])->name('rent-logs')->middleware('admin');

    // client
    Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('client');
});
