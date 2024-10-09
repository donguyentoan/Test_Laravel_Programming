<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProductController;

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

Route::get('/',[HomeController::class , 'home']);

Route::get('/login' , [AuthorController::class ,'login']);
Route::post('/login' , [AuthorController::class ,'loginUser']);
Route::get('/cart' , [CartController::class ,'cart']);
Route::get('/register' , [AuthorController::class ,'register']);
Route::post('/register' , [AuthorController::class ,'createUser']);
Route::get('/product/{id}' , [HomeController::class ,'detail']);

Route::get('/dashboard' , [AdminController::class ,'index'])->name('dashboard');
Route::get('/logout' , [AuthorController::class ,'logout']);


Route::get('/dashboard/product' , [ProductController::class ,'index']);


Route::get('/addProduct' , [ProductController::class ,'add']);

Route::post('/uploads' , [ProductController::class ,'addProduct']);

Route::get('dashboard/product/edit/{id}' , [ProductController::class ,'edit']);
Route::get('/dashboard/product/delete/{id}' , [ProductController::class ,'delete']);

Route::post('/update/product' , [ProductController::class ,'store']);


Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

