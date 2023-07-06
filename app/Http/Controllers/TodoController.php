<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


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

      if ($request->filled('tags')) {
        $this->createTags($todo, $request->tags);
      }

      if ($request->hasFile('image')) {
        $path = $request->image->store('public');
      }

      return new TodoResource($todo);
    }


    public function update(Request $request, Todo $todo) {
      $todo->text = $request->text;

      if ($request->filled('tags')) {
        $tags = $request->tags;

        DB::transaction(function () use($todo, $tags) {
          $todo->tags()->delete();

          $this->createTags($todo, $tags);
        });
      }
 
      $todo->save();

      return new TodoResource($todo);
    }

    private function createTags(Todo $todo, array $tags) {
      $tags = array_map(function($tag) {
        return ['text' => $tag];
      }, $tags);

      $todo->tags()->createMany($tags);
    }
}
