<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return redirect()->route('home');
})->name('main');

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [HomeController::class, 'profile'])->middleware('auth')->name('profile');
    Route::post('/profile/update', [HomeController::class, 'profileUpdate'])->name('profileUpdate');
});


// Route::any('/{any}', function () {
//     return redirect(route('main'));
// })->where('any', '.*');

Auth::routes();

Route::get('/categories/{category}', [CategoryController::class, 'category'])->name('category');

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {

    Route::redirect('/', '/admin/products');

    /*
    Route::get('/', function () {
        return redirect(route('adminProducts'));
    });
     */


    Route::get('/products', function () {
        return 'Админка: продукты';
    })->name('adminProducts');
});