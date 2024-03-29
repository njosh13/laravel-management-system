<?php

namespace App\Http\Controllers;

use App\Models\BookLoan;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [LandingPageController::class, "index"])->name('index');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');

    // User Books
    Route::get('all-books', [UserBookController::class, "allBooks"])->name('books.all');

    // User Books
    Route::resource('my-books', UserBookLoanController::class);

    // Admin Pages 
    Route::group(
        [
            'prefix' => 'admin',
            'as' => 'admin.',
        ],
        static function () {
            // Books
            Route::resource('books', BookController::class);
            // Books
            Route::resource('book-loans', BookLoanController::class);
            Route::patch('book-loans/{bookLoan}/update_status{status}', [BookLoanController::class, 'updateBookLoanStatus'])->name('book-loans.update_status');

            // Users
            Route::resource('users', UserController::class);
        }
    );
});
