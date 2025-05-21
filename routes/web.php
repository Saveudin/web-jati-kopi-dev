<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StockMovementController;
use App\Http\Middleware\RedirectIfAuthenticatedCustom;

Route::middleware(RedirectIfAuthenticatedCustom::class)->group(function () {
// Login & Register
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('sales.report');
})->name('dashboard');

Route::get('/admin/materials', [MaterialController::class, 'index'])->name('materials');
Route::post('/admin/material', [MaterialController::class, 'store'])->name('material.post');
Route::put('/admin/material/{id}', [MaterialController::class, 'update'])->name('material.update');
Route::delete('/admin/material/{id}', [MaterialController::class, 'destroy'])->name('material.delete');

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.post');
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

Route::get('/admin/products', [ProductController::class, 'index'])->name('products');
Route::post('/admin/product', [ProductController::class, 'store'])->name('product.post');
Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');

Route::get('/admin/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::post('/admin/recipe', [RecipeController::class, 'store'])->name('recipe.post');
Route::put('/admin/recipe/{id}', [RecipeController::class, 'update'])->name('recipe.update');
Route::delete('/admin/recipe/{id}', [RecipeController::class, 'destroy'])->name('recipe.delete');

Route::get('/admin/sales', [SaleController::class, 'index'])->name('sales');
Route::post('/admin/sale', [SaleController::class, 'store'])->name('sale.post');
Route::get('/admin/sales-report', [SaleController::class, 'report'])->name('sales.report');
Route::get('/admin/sales-report/pdf', [SaleController::class, 'exportPDF'])->name('sales.export.pdf');

Route::get('/transactions/{id}/print', [SaleController::class, 'print'])->name('transactions.print');


Route::get('/stock-movements', [StockMovementController::class, 'index'])->name('stock_movements.index');

});