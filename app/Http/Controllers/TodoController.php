<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Models\Todo;

use App\Http\Resources\TodoResource;


class TodoController extends Controller
{
    public function store(Request $request) {
      $todo = new Todo;
 
      $todo->text = $request->text;
      $todo->user_id = Auth::id();
 
      $todo->save();


      return new TodoResource($todo);
    }
}
