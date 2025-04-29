<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin', function() {
    return view('components.home');
})->name('admin');

Route::get('/admin/materials', [MaterialController::class, 'index'])->name('materials');
Route::post('/admin/material', [MaterialController::class, 'store'])->name('material.post');
Route::put('/admin/material/{id}', [MaterialController::class, 'update'])->name('material.update');
Route::delete('/admin/material/{id}', [MaterialController::class, 'destroy'])->name('material.delete');

Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');
Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.post');
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

Route::get('/admin/products', [ProductController::class, 'index'])->name('products');
Route::post('/admin/product', [ProductController::class, 'store'])->name('product.post');