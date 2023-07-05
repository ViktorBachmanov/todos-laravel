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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
  return view('todos');
})->middleware('auth');


Route::get('/todo/{todo}', [TodoController::class, 'index'])->middleware('auth');
Route::post('/todo', [TodoController::class, 'store'])->middleware('auth');

