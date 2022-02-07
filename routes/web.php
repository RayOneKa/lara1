<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::any('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');



Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth')->name('profile');
    Route::post('/profile/update', [HomeController::class, 'profileUpdate'])->name('profileUpdate');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

    // Route::redirect('/', '/admin/products');

    /*
    Route::get('/', function () {
        return redirect(route('adminProducts'));
    });
     */

    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/enterAsUser/{userId}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');

    Route::get('/products', function () {
        return 'Админка: продукты';
    })->name('adminProducts');
});