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

    /**
     * Store the new Todo.
     */
    public function store(Request $request) {
      $todo = new Todo;
 
      $todo->text = $request->text;
      $todo->user_id = Auth::id();

      $todo->save();

      if(count($request->tags)) {
        $tags = array_map(function($tag) {
          return ['text' => $tag];
        }, $request->tags);

        $todo->tags()->createMany($tags);
      }


      return new TodoResource($todo);
    }


    public function update(Request $request, Todo $todo) {
      $todo->text = $request->text;
 
      $todo->save();

      return new TodoResource($todo);
    }
}
