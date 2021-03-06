<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

// Auth::routes();

Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::post('logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'index'])->name('basket');
    Route::get('/getProductsQuantity', [BasketController::class, 'getProductsQuantity']);
    Route::post('/createOrder', [BasketController::class, 'createOrder'])->name('createOrder');
    Route::prefix('product')->group(function () {
        Route::post('/add', [BasketController::class, 'add'])->name('addProduct');
        Route::post('/remove', [BasketController::class, 'remove'])->name('removeProduct');
    });
});

Route::middleware('auth:sanctum')->prefix('categories')->group(function () {
    Route::get('/get', [CategoryController::class, 'getCategories'])->withoutMiddleware('auth:sanctum');
    Route::get('{category}', [CategoryController::class, 'category'])->name('category');
    Route::get('{category}/getProducts', [CategoryController::class, 'getProducts']);
});

Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::post('/users', [AdminController::class, 'users']);
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/enterAsUser/{userId}', [AdminController::class, 'enterAsUser'])->name('enterAsUser');
    Route::post('/exportCategories', [AdminController::class, 'exportCategories'])->name('exportCategories');

    Route::get('/products', function () {
        return '??????????????: ????????????????';
    })->name('adminProducts');
});