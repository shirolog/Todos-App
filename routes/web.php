<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/todos', [TodoController::class, 'index'])
    ->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])
    ->name('todos.create');
    Route::post('/todos/create', [TodoController::class, 'store'])
    ->name('todos.store');
    Route::get('/todos/show/{todo}', [TodoController::class, 'show'])
    ->name('todos.show');
    Route::get('/todos/edit/{todo}', [TodoController::class, 'edit'])
    ->name('todos.edit');
    Route::put('/todos/edit/{todo}', [TodoController::class, 'update'])
    ->name('todos.update');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])
    ->name('todos.destroy');
});