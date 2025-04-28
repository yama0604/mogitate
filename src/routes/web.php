<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

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

Route::get('/products', [ProductsController::class,'index']);
Route::get('/products/search', [ProductsController::class,'search']);
Route::get('/products/register', [ProductsController::class,'showRegister']);
Route::post('/products/register', [ProductsController::class,'register']);
Route::get('/products/{productId}', [ProductsController::class,'product']);
Route::patch('/products/{productId}/update', [ProductsController::class, 'update']);
Route::delete('/products/{productId}/delete', [ProductsController::class, 'delete']);