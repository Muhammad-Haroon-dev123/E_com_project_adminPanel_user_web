<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\shoppingCard;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;




Route::get('/',[userController::class,'index'])->name('index');
Route::get('/product',[userController::class,'product'])->name('product');
Route::get('/category/{slug}/products', [userController::class, 'showProducts'])->name('category.allproducts');
Route::get('/single/product/{id}', [userController::class, 'show'])->name('single.product');
Route::get('/add-to-card/{id}', [userController::class, 'addToCard'])->name('add.to.card');

//-------card session routes------
Route::post('/add-to-cart', [shoppingCard::class, 'add'])->name('cart.add');
Route::get('/shopping-cart', [shoppingCard::class, 'index'])->name('shopping.cart');
Route::get('/remove-from-cart/{id}', [shoppingCard::class, 'remove'])->name('cart.remove');
//-------admin routes------

Route::middleware(['auth','guest'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('/add-product',[AdminController::class,'addproduct'])->name('add_product');
    route::get('/all-product',[AdminController::class,'allproduct'])->name('all_product');
    Route::post('/products/store', [AdminController::class, 'create'])->name('products.store');
    Route::get('/products/{id}/edit',[AdminController::class,'edit'])->name('products.edit');
    Route::post('/products/{id}', [AdminController::class,'update'])->name('products.update');
    Route::get('/products/{id}/delete', [AdminController::class,'delete'])->name('products.delete');
    //------Category Routes------
    Route::get('/add-show-category',[categoryController::class,'index'])->name('add_show_category');
    Route::post('/category/store', [categoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [categoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [categoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [categoryController::class, 'destroy'])->name('category.delete');    
    Route::get('/category/{slug}', [categoryController::class, 'showProducts'])->name('category.products');
    Route::get('/category/{category}/product/{product}/remove',[categoryController::class, 'removeProduct'])->name('category.product.remove'); 
});

////-------customer routes------

// Route::middleware(['auth','role:customer'])->group(function () {
//         Route::get('/customer/dashboard',[AdminController::class,'index_counter'])->name('user_dashboard');
// });
require __DIR__.'/auth.php';
