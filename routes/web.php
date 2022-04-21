<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderLinesController;

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


Route::middleware([
    'auth:sanctum','verified'
])->get('/dashboard', function () {
        return redirect("/");
});

//Admin Routes
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware("auth.admin");
Route::get('/admin-dashboard/allProducts', [AdminController::class, 'showAllProducts'])->name('allProducts')->middleware("auth.admin");
Route::post('/admin-profile/update', [AdminController::class, 'update'])->name('admin.update.profile')->middleware("auth.admin");



Route::get('/admin/profile', [AdminController::class, 'showAdminProfile'])->name('admin.profile.show');
Route::get('/admin/login', [AdminController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

// Home Routes

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/category/{slug}', [HomeController::class, 'getProductsByCategory'])->name('products.by.category');

// Products routs:

Route::get('product/details/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('product/add', [ProductController::class, 'create'])->name('product.create')->middleware("auth.admin");
Route::post('product/add', [ProductController::class, 'store'])->name('product.store')->middleware("auth.admin");
Route::get('product/edit/{slug}', [ProductController::class, 'edit'])->name('product.edit')->middleware("auth.admin");
Route::post('product/update/{slug}', [ProductController::class, 'update'])->name('product.update')->middleware("auth.admin");
Route::post('product/delete/{slug}', [ProductController::class, 'destroy'])->name('product.delete')->middleware("auth.admin");

// Cart (Order lines) routs

Route::get('cart/', [CartController::class, 'show'])->name('cart.show');
Route::post('cart/add/{slug}', [CartController::class, 'addProduct'])->name('cart.add');
Route::post('cart/delete/{key}', [CartController::class, 'deleteProduct'])->name('cart.delete.product');
Route::post('cart/edit/{key}', [CartController::class, 'editProduct'])->name('cart.edit.product');

//Order routes

Route::get('order/checkout', [OrderController::class, 'create'])->name('order.create')->middleware('auth');
Route::get('order/save', [OrderController::class, 'store'])->name('order.store')->middleware('auth');
