<?php

namespace App\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
class TodoController extends Controller
{
    public function getAllTodos() {
        $todos =Todo::all();

        return response()->json($todos)->setStatusCode(200);
    }
    public function addTodo()
    {
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
        return response()->json(["title" => $data['title'], "description" => $data['title'], "message" => "User Successfully Added", "status" => 200])->
        setStatusCode(200)->
        header('Access-Control-Allow-Origin', '*')->
        header('Access-Control-Allow-Methods', '*')->
        header('Access-Control-Allow-Headers', '*')->
        header('Content-Type', 'application/json');
    }

    public function readUserByID($id)
    {
        $todo = DB::table('todos')->where([
            'id' => $id,
        ])->first();

        if ($todo == null) {
            return response()->json(["message" => "User not found", "status" => 404])->setStatusCode(401);
        }
        return response()->json(["id"=>$todo->id, "title" => $todo->title, "description" => $todo->description, "created_at" => $todo->created_at, "updated_at"=>$todo->updated_at])->setStatusCode(200);
    }

    public function deleteTodo($id)
    {
        $todo = DB::table('todos')->where([
            'id' => $id,
        ])->first();

        if ($todo == null) {
            return response()->json(["message" => "Todo not found", "status" => 404])->setStatusCode(401);
        }

        DB::table('todos')->delete([
            'id' => $id,
        ]);
        return response()->json(["message" => "Todo Successfully Deleted", "status" => 200])->
        setStatusCode(200)->
        header('Access-Control-Allow-Origin', '*')->
        header('Access-Control-Allow-Methods', '*')->
        header('Access-Control-Allow-Headers', '*');
    }

    public function updateTodoByID($id)
    {
        $todo = DB::table('todos')->where([
            'id' => $id,
        ])->first();

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($todo == null) {
            return response()->json(["message" => "Todo not found", "status" => 404])->setStatusCode(401);
        }


        DB::table('todos')->where(["id"=>$id])->update([
            'updated_at' => now(),
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return response()->json(["message" => "Todo Successfully Updated", "status" => 200])->setStatusCode(200);
    }
    public function refreshTodo()
    {
        $todos = Todo::all();
        return view('welcomes',compact('todos'));
    }
}
