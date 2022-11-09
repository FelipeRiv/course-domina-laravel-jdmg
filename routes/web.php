<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\ProductCartController;
use App\Models\Product;
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

Route::get('/', [MainController::class, 'index'])->name('main'); // alias de mi ruta y puedo usar php artisan tinker y route('main');  // reiniciar tinker si estuviera activo


// ## All these routes can be simplified in one with the resource route that is a gruop of routes that belongs to a specific resource like products it means that a resource is any of our models it uses the same methods index create show store etc
Route::resource('products', ProductController::class);

Route::resource('carts', CartController::class)->only('index');

Route::resource('orders', OrderController::class)->only(['create', 'store']);

Route::resource('orders.payments', OrderPaymentController::class)->only(['create', 'store']);

Route::resource('products.carts', ProductCartController::class)->only(['store', 'destroy']);

// * In the same way as middlewares we can have only some routes that we actually want or make exception with except if we dont want some routes, if we test it but we have those methods in our controller it'll show an error so we have to comment or delete those methods there
// ->only(['index', 'show']);
// ->except(['delete', 'update']);

// If we need more routes that are different than the ones in Routes::resource we can use the usuall Routes to create them 

// // ## 
// // Show all productos
// Route::get('products', [ProductController::class, 'index'])->name('products.index'); // convencion de nombre  products con index de que trae todos los productos

// // View to create a product 
// Route::get('products/create', [ProductController::class, 'create'])->name('products.create'); // this call products.store to save the product

// // Create products
// Route::post('products', [ProductController::class, 'store'])->name('products.store'); // convencion de nombre  products con index de que trae todos los productos

// // Show a specific product | the order of the routes its important bc create product route could be prioritized
// Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

// // Edit product the form to edit the product
// Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit'); // convencion de nombre  products con index de que trae todos los productos


// // Update product
// // We could have put y patch but we can use a method to know what http methods are able to be used in this route in this case put and patch 
// Route::match(['put', 'patch'], 'products/{product}', [ProductController::class, 'update'])->name('products.update');

// // Delete product
// Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
