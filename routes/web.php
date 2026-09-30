<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Resource routes
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('members', MemberController::class);

// Custom route pengembalian buku (ditaruh sebelum resource loans)
Route::match(['put', 'patch'], '/loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])
    ->name('loans.kembalikan');

Route::resource('loans', LoanController::class);

// Route group admin
Route::prefix('admin')->group(function () {
    Route::get('/info', function () {
        return 'Sistem Informasi Perpustakaan - Panel Admin';
    })->name('admin.info');
});