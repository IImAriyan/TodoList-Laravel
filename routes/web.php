<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
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


// Get All Todos
Route::get('/api/todos/list', function () {
    $todos =Todo::all();

    return response()->json($todos)->setStatusCode(200);
});

// Add Todos
Route::post('/api/todos/add' , function () {
    $data = request()->validate([
        'title' => 'required',
        'description' => 'required',
    ]);
    DB::table('todos')->insert([
        'title' => $data['title'],
        'description' => $data['description'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return response()->json(["title" => $data['title'], "description" => $data['title']])->
    setStatusCode(200)->
    header('Access-Control-Allow-Origin', '*')->
    header('Access-Control-Allow-Methods', '*')->
    header('Access-Control-Allow-Headers', '*')->
    header('Content-Type', 'application/json');

}) ;
