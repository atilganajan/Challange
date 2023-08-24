<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\CartController;

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


Route::get('/', [HomeController::class, 'index']);
Route::get('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);
Route::post('/user/login', [UserController::class, 'userLogin']);
Route::post('/user/create', [UserController::class, 'store']);

Route::get('/product/detail/{id}', [HomeController::class, 'productDetail']);

Route::middleware('auth')->group(function () {
    Route::post('/add-to-cart', [CartController::class,'addToCart']);
    Route::post('/remove-item-to-cart', [CartController::class,'removeItemToCart']);
});

Route::prefix('admin')->middleware(['admin.role'])->group(function () {
    Route::match(['get', 'post'], 'categories', [AdminController::class, 'categoryList']);
    Route::get('category-create', [AdminController::class, 'categoryCreate']);
    Route::post('category/add-category', [AdminController::class, 'addCategory']);
    Route::get('category/edit/{id}', [AdminController::class, 'editCategory']);
    Route::post('category/update-category', [AdminController::class, 'updateCategory']);
    Route::delete('category/delete', [AdminController::class, 'deleteCategory']);

    Route::get('product-create', [AdminController::class, 'productCreate']);
    Route::post('product/add-product', [AdminController::class, 'addProduct']);
    Route::match(['get', 'post'], 'products', [AdminController::class, 'productList']);
    Route::get('product/edit/{id}', [AdminController::class, 'editProduct']);
    Route::post('product/update-product', [AdminController::class, 'updateProduct']);
    Route::delete('product/delete', [AdminController::class, 'deleteProduct']);
});

