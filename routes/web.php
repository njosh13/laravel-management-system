<?php

namespace App\Http\Controllers;

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


    // Admin Pages 
    Route::group(
        [
            'prefix' => 'admin',
            'as' => 'admin.',
        ],
        static function () {
            // Books
            Route::resource('books', BookController::class);
            // Users
            Route::resource('users', UserController::class);
        }
    );
});
