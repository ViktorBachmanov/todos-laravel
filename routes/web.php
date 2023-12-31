<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;


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


Route::get('/', [TodoController::class, 'index'])->middleware('auth');

Route::get('/todos/{todo}', [TodoController::class, 'show'])->middleware('auth');
Route::post('/todos', [TodoController::class, 'store'])->middleware('auth');
Route::patch('/todos/{todo}', [TodoController::class, 'update'])->middleware('auth');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->middleware('auth');

