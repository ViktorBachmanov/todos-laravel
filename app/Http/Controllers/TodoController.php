<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Models\Todo;
use App\Models\User;

use App\Http\Resources\TodoResource;


class TodoController extends Controller
{
    public function index() {
      return view('todos', ['todos' => Auth::user()->todos]);
    }


    public function show(Todo $todo) {
      return new TodoResource($todo);
    }


    public function store(Request $request) {
      $todo = new Todo;
 
      $todo->text = $request->text;
      $todo->user_id = Auth::id();
 
      $todo->save();


      return new TodoResource($todo);
    }
}
