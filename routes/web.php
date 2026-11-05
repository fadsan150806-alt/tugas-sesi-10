<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserRoleController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Semua route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {

    // ==========================================
    // DASHBOARD
    // ==========================================

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // ==========================================
    // MANAJEMEN BUKU
    // ==========================================

    // Semua role yang memiliki permission books.view
    // boleh melihat daftar dan detail buku.
    Route::middleware(['permission:books.view'])->group(function () {

        Route::get('/books', [BookController::class, 'index'])
            ->name('books.index');

    });


    // ==========================================
    // TAMBAH BUKU
    // Admin dan Dosen
    // ==========================================

    Route::middleware(['permission:books.create'])->group(function () {

        Route::get('/books/create', [BookController::class, 'create'])
            ->name('books.create');

        Route::post('/books', [BookController::class, 'store'])
            ->name('books.store');

    });


    // ==========================================
    // EDIT BUKU
    // Admin dan Dosen
    // ==========================================

    Route::middleware(['permission:books.edit'])->group(function () {

        Route::get('/books/{book}/edit', [BookController::class, 'edit'])
            ->name('books.edit');

        Route::put('/books/{book}', [BookController::class, 'update'])
            ->name('books.update');

    });


    // ==========================================
    // HAPUS BUKU
    // Hanya Admin
    // ==========================================

    Route::middleware(['permission:books.delete'])->group(function () {

        Route::delete('/books/{book}', [BookController::class, 'destroy'])
            ->name('books.destroy');

    });


    // ==========================================
    // DETAIL BUKU
    // Diletakkan setelah route statis dan edit.
    // ==========================================

    Route::middleware(['permission:books.view'])->group(function () {

        Route::get('/books/{book}', [BookController::class, 'show'])
            ->name('books.show');

    });


    // ==========================================
    // MANAJEMEN ROLE PENGGUNA
    // Hanya Admin
    // ==========================================

    Route::middleware(['permission:users.manage_roles'])->group(function () {

        Route::get('/users', [UserRoleController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}/edit', [UserRoleController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}/role', [UserRoleController::class, 'update'])
            ->name('users.updateRole');

    });

});

// Route autentikasi dari Laravel Breeze
require __DIR__.'/auth.php';
