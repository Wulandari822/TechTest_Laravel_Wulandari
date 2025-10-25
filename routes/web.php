<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RatingController;
use App\Exports\AuthorsExport;
use Maatwebsite\Excel\Facades\Excel;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function () {

    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/books', [BooksController::class, 'index'])
        ->name('books');
        Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
                Route::get('/detail-transaksi', [TransactionController::class, 'index'])->name('detail-transaksi');
                Route::post('/ratings', [App\Http\Controllers\RatingController::class, 'store'])->name('ratings.store');

    
    Route::middleware('isAdmin')->group(function () {
        Route::get('/author', [AuthorsController::class, 'index'])->name('author');
        Route::post('/author/store', [AuthorsController::class, 'store'])->name('author.store');
        Route::put('/author/update/{id}', [AuthorsController::class, 'update'])->name('author.update');
        Route::delete('/author/delete/{id}', [AuthorsController::class, 'destroy'])->name('author.destroy');
        Route::get('/authors/export', function () {return Excel::download(new AuthorsExport, 'authors.xlsx');})->name('author.export');

        Route::post('/book/store', [BooksController::class, 'store'])->name('book.store');
        Route::put('/book/update/{id}', [BooksController::class, 'update'])->name('book.update');
        Route::delete('/book/delete/{id}', [BooksController::class, 'destroy'])->name('book.destroy');

        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


    Route::middleware('guest')->group(function () {
        Route::get('/', [RegisterController::class, 'index'])->name('register');
        Route::post('/', [RegisterController::class, 'register']);

        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
});





