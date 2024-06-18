<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactsController;

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

Route::get('/', [AboutController::class, 'index']);

Route::get('/catalog', [CatalogController::class, 'getProducts'])->name('catalog');
Route::get('/about', [AboutUsController::class, 'index']);
Route::get('/contacts', [ContactsController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'index'])->name('product');

Route::middleware(['auth', 'is-admin'])->group(function () {
    Route::get('/product-create', [ProductController::class, 'createProductView']);
    Route::post('/product-create', [ProductController::class, 'createProduct']);
    Route::get('/products', [ProductController::class, 'getProducts'])->name('admin.products');
    Route::get('/product-edit/{id}', [ProductController::class, 'getProductById']);
    Route::patch('/product-update/{id}', [ProductController::class, 'editProduct']);
    Route::delete('/product-delete/{id}', [ProductController::class, 'deleteProduct']);

    Route::get('/category-create', [CategoriesController::class, 'createCategoryView']);
    Route::post('/category-create', [CategoriesController::class, 'createCategory']);
    Route::get('/categories', [CategoriesController::class, 'getCategories'])->name('admin.categories');
    Route::get('/category-edit/{id}', [CategoriesController::class, 'getCategoryById']);
    Route::patch('/category-update/{id}', [CategoriesController::class, 'editCategory']);
    Route::delete('/category-delete/{id}', [CategoriesController::class, 'deleteCategory']);

    Route::get('/orders', [OrderController::class, 'getOrders'])->name('admin.orders');
    Route::patch('/order-status/{action}/{number}', [OrderController::class, 'editOrderStatus']);
});

Route::middleware('auth')->group(function () {
    Route::get('/user', [ProfileController::class, 'index'])->name('user');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/changeqty/{param}/{id}', [CartController::class, 'changeQty']);
    Route::get('/create-order', [OrderController::class, 'index'])->name('create-order');
    Route::post('/create-order', [OrderController::class, 'createOrder']);
    Route::delete('/order-delete/{number}', [OrderController::class, 'deleteOrder']);
});

require __DIR__.'/auth.php';
