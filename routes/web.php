<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use \App\Controllers\TodoController;
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


Route::get('/', function () {
    $todos = Todo::all();
    return view('welcome',compact('todos'));
});

# Start Routes


// Get All Todos
Route::get('/api/todos/list',[TodoController::class,'getAllTodos']);
// Add Todos
Route::post('/api/todos/add', [TodoController::class,'addTodo']) ;
// read By ID And Return User
Route::get('/api/todos/{id}' ,[TodoController::class,'readUserByID']);
// delete user by id
Route::post('/api/todos/delete/{id}',[TodoController::class,'deleteTodo']);
// update user by id
Route::post('/api/todos/update/{id}', [TodoController::class,'updateTodoByID']);
// Refresh Todos
Route::get('/api/todos/refresh',[TodoController::class,'refreshTodo']);
# End Routes
