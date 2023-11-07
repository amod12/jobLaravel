<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;

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

Route::get('/',[ItemController::class,'index']);

Route::get('/item/create', [ItemController::class, 'create'])->middleware('auth');

Route::post('/item', [ItemController::class, 'store']);

Route::get('/items/manage', [ItemController::class, 'manage'])->middleware('auth');


Route::get('/item/{item}', [ItemController::class, 'show']);

Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->middleware('auth');

Route::put('/item/{item}', [ItemController::class, 'update']);

Route::delete('/item/{item}', [ItemController::class, 'destroy']);

Route::get('/register', [UserController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

