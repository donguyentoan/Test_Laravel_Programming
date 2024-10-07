<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;

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
Route::get('/cart' , [CartController::class ,'cart']);
Route::get('/register' , [AuthorController::class ,'register']);
Route::get('/product/{id}' , [HomeController::class ,'detail']);


