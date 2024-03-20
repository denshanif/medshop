<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\CustomerManagementController;

use App\Http\Middleware\Admin;

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

// Homepages
Route::get('/', [HomeController::class, 'index']);
Route::get('/?category={category}', [HomeController::class, 'index']);
Route::get('/?search={search}', [HomeController::class, 'index']);
Route::get('/?sort={sort}', [HomeController::class, 'index']);

// Product details
Route::get('/product/{id}', [HomeController::class, 'show']);

// Cart
Route::get('/cart', [HomeController::class, 'cart']);
Route::post('/cart', [HomeController::class, 'addToCart']);

// Checkout
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::post('/checkout', [HomeController::class, 'placeOrder']);

// Orders
Route::get('/my-orders', [HomeController::class, 'myOrders']);
Route::post('/cancel-order/{id}', [HomeController::class, 'cancelOrder']);

// Invoice
Route::get('/invoice/{id}', [HomeController::class, 'invoice']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return view('admin.dashboard');
    })->name('home')->middleware('admin');

    // Product routes
    Route::get('/admin/products', [ProductController::class, 'index'])->middleware('admin');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->middleware('admin');
    Route::post('/admin/products', [ProductController::class, 'store'])->middleware('admin');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->middleware('admin');
    Route::post('/admin/products/{id}', [ProductController::class, 'update'])->middleware('admin');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->middleware('admin');

    // Category routes
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::get('/admin/categories/create', [CategoryController::class, 'create']);
    Route::post('/admin/categories', [CategoryController::class, 'store']);
    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/admin/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy']);

    // Unit routes
    Route::get('/admin/units', [UnitController::class, 'index']);
    Route::get('/admin/units/create', [UnitController::class, 'create']);
    Route::post('/admin/units', [UnitController::class, 'store']);
    Route::get('/admin/units/edit/{id}', [UnitController::class, 'edit']);
    Route::post('/admin/units/{id}', [UnitController::class, 'update']);
    Route::delete('/admin/units/{id}', [UnitController::class, 'destroy']);

    // User routes
    Route::get('/admin/users', [UserManagementController::class, 'index']);
    Route::get('/admin/users/create', [UserManagementController::class, 'create']);
    Route::post('/admin/users', [UserManagementController::class, 'store']);
    Route::get('/admin/users/edit/{id}', [UserManagementController::class, 'edit']);
    Route::post('/admin/users/{id}', [UserManagementController::class, 'update']);
    Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy']);

    // Order routes
    Route::get('/admin/orders', [OrderManagementController::class, 'index']);
    Route::get('/admin/orders/{id}', [OrderManagementController::class, 'show']);
    Route::delete('/admin/orders/{id}', [OrderManagementController::class, 'destroy']);
});
