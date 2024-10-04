<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
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
Route::get('/', function () {
    $todos =Todo::all();

    return response()->json($todos)->setStatusCode(200)->header('Content-Type');
});
