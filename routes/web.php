<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get( '/', [ HomeController::class, 'home' ] );

Route::get( '/login', [ LoginController::class, 'login' ] );
Route::post( '/login', [ LoginController::class, 'loginUser' ] )->middleware( 'loginRequestMiddleware' );

Route::get( '/cart', [ CartController::class, 'cart' ] );
Route::post( '/cart', [ CartController::class, 'saveCart' ] );
Route::post( '/del/cart', [ CartController::class, 'removeCart' ] );
Route::post( '/update/cart', [ CartController::class, 'updateCart' ] );

Route::get( '/register', [ RegisterController::class, 'register' ] );
Route::post( '/register', [ RegisterController::class, 'createUser' ] )->middleware( 'registerRequestMiddleware' );
Route::get( '/product/{id}', [ ProductController::class, 'detail' ] );

Route::get( '/dashboard', [ AdminController::class, 'index' ] )->name( 'dashboard' );
Route::get( '/logout', [ LoginController::class, 'logout' ] );

Route::get( '/dashboard/product', [ AdminController::class, 'indexProduct' ] );

Route::get( '/addProduct', [ AdminController::class, 'add' ] );

Route::post( '/uploads', [ AdminController::class, 'addProduct' ] )->middleware( 'productRequestMiddleware' );

Route::get( 'dashboard/product/edit/{id}', [ AdminController::class, 'edit' ] );
Route::get( '/dashboard/product/delete/{id}', [ AdminController::class, 'delete' ] );

Route::post( '/update/product', [ AdminController::class, 'store' ] )->middleware( 'productRequestMiddleware' );
;

Route::get( '/products/search', [ SearchController::class, 'search' ] )->name( 'products.search' );

Route::get( '/checkout', [ CheckoutController::class, 'index' ] );

Route::get( '/checkout', [ CheckoutController::class, 'index' ] );
Route::get( '/delete/elastic/{id}', [ ProductController::class, 'deleteProduct' ] );
