<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminMessageController;

route::get('/', [HomeController::class, 'home'])->name('home');

route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

route::get('/myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

// Admin routes
route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin']);
route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin']);
route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin']);
route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin']);
route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin']);
route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin']);
route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);
route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin']);
route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin']);

// Update product routes
route::get('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin']);
route::put('edit_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin']);  // Use PUT method for updating
route::get('product_search', [AdminController::class, 'product_search'])->middleware(['auth', 'admin']);
route::get('view_orders', [AdminController::class, 'view_orders'])->middleware(['auth', 'admin']);
route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin']);
route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin']);
route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware(['auth', 'admin']);
Route::get('/completed_orders', [AdminController::class, 'completed_orders'])->name('completed_orders');

// Product and Cart routes
route::get('product_details/{id}', [HomeController::class, 'product_details']);
route::post('add_cart/{id}', [HomeController::class, 'add_cart'])->middleware(['auth', 'verified'])->name('add.cart');
route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);
route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->middleware(['auth', 'verified']);
route::post('confirm_order', [HomeController::class, 'confirm_order'])->middleware(['auth', 'verified']);

// Home routes
route::get('shop', [HomeController::class, 'shop']);
route::get('why', [HomeController::class, 'why']);
route::get('testimonial', [HomeController::class, 'testimonial']);
route::get('contact', [HomeController::class, 'contact']);

// Contact Routes
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/admin/messages', [AdminController::class, 'messages'])->name('admin.messages')->middleware('auth');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('admin/messages', [AdminMessageController::class, 'index'])->name('admin.messages');
