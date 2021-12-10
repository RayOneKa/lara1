<?php

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
    return view('welcome');
})->name('main');

Route::get('/test', function () {
    return 'Вы на тестовой странице';
});


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('postRequestTest', function () {
    return '<button>!!!!</button>';
})->name('postRequestTest');

// Route::any('/{any}', function () {
//     return redirect(route('main'));
// })->where('any', '.*');

Auth::routes();

Route::get('/home/test', [App\Http\Controllers\HomeController::class, 'test']);

Route::get('/categories/{id}', [App\Http\Controllers\HomeController::class, 'category']);

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