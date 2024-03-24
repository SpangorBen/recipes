<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [CategoryController::class, 'index']);

// Route::post('/' , [CategoryController::class, 'store']);

Route::get('/', [RecipeController::class, 'index'])->name('welcome');

Route::post('/', [RecipeController::class, 'store']);

Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('edit');
Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('update');

Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('destroy');

Route::get('/search', [RecipeController::class, 'search'])->name('search');


