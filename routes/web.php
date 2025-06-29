<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\StudentController;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register.form');
Route::post('/register', [AuthController::class, 'RegisterPost'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/log-out', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes
Route::prefix('admin')->middleware(['auth', RoleMiddleware::class . ':admin'])->name('admin.')->group(function () {
    Route::get('/buku', [BookController::class, 'index'])->name('books');
    Route::get('/buku/tambahBuku', [BookController::class, 'create'])->name('book.create');
    Route::post('/buku/simpan', [BookController::class, 'store'])->name('book.store');
    Route::get('/buku/{id}', [BookController::class, 'show'])->name('book.show');
    Route::get('/buku/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/buku/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/buku/{book}', [BookController::class, 'destroy'])->name('book.destroy');
});


// User routes
Route::prefix('user')->middleware(['auth', RoleMiddleware::class . ':user'])->name('user.')->group(function () {
    Route::view('/dashboard', 'user.test')->name('dashboard');
});






Route::get('/student', [StudentController::class, 'index']);
Route::get('/student/{nim}', [StudentController::class, 'show']);
