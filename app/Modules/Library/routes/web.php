<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Library\Controllers\AuthorController;
use App\Modules\Library\Controllers\BookController;

Route::prefix('library')->group(function () {
    Route::resource('authors', AuthorController::class);
    Route::resource('books', BookController::class);
    Route::post('books/{book}/pinjam', [BookController::class, 'pinjam'])->name('books.pinjam');
    Route::post('books/{book}/kembali', [BookController::class, 'kembali'])->name('books.kembali');
});