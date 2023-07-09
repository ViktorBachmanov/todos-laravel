<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;


use App\Models\Todo;
use App\Models\User;
use App\Models\Image;
use App\Models\Tag;

use App\Http\Resources\TodoResource;

use function App\Util\createPreviewImage;


class TodoController extends Controller
{
    /**
     * Show the all Todos.
     */
    public function index(Request $request) {
      $search = $request->query('search', null);
      if($search) {
        return redirect('/')->with('search', $search);
      }

      $todos = Auth::user()->todos;

      $search = session('search');
      if($search) {
        $todos = $todos->filter(function($todo) use ($search) {
          return Str::contains($todo->text, $search);
        });
      }

      $filterTagsCheck = isset($_COOKIE['filter-tags-check'])
         ? json_decode($_COOKIE['filter-tags-check'])
         : false;

      $filterTags = isset($_COOKIE['filter-tags'])
        ? json_decode($_COOKIE['filter-tags'])
        : [];
      
      if($filterTagsCheck && count($filterTags) > 0) {
        $todos = $this->filterTodos($todos, $filterTags);
      }

      return view('todos', [
        'todos' => $todos,
        'filterTagsCheck' => $filterTagsCheck,
        'filterTags' => $filterTags,
      ]);
    }

    private function filterTodos($todos, array $filterTags) {
      return $todos->filter(function($todo) use ($filterTags) {
        return $todo->tags->contains(function($tag) use ($filterTags) {
          return in_array($tag->text, $filterTags);
        });
      });

    }
    

    /**
     * Get the Todo resource.
     */
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
        $this->createTags($request->tags, $todo);
      }

      if ($request->hasFile('image')) {
        $this->createImages($request->image, $todo);
      }

      return new TodoResource($todo);
    }

    
    /**
     * Update the Todo.
     */
    public function update(Request $request, Todo $todo) {
      $todo->text = $request->text;

      if ($request->filled('tags')) {
        $tags = $request->tags;

        DB::transaction(function () use ($tags, $todo) {
          $todo->tags()->delete();

          $this->createTags($tags, $todo);
        });
      }

      if ($request->hasFile('image')) {
        $image = $request->image;

        DB::transaction(function () use($image, $todo) {
          $todo->images()->delete();

          $this->createImages($image, $todo);
        });
      }
      else if ($request->delete_image) {
        $todo->images()->delete();
      }

      $todo->save(); 

      return new TodoResource($todo);
    }

    /**
     *  Destroy the Todo.
     */
    public function destroy(Todo $todo) {
      return $todo->delete();
    }

    //========================================================

    private function createTags(array $tags, Todo $todo) {
      $tags = array_map(function($tag) {
        return ['text' => $tag];
      }, $tags);

      $todo->tags()->createMany($tags);
    }

    //--------------------------------------------------------

    private function createImages($requestImage, Todo $todo) {
      $path = Storage::disk('public')->putFile('', $requestImage);

      Image::create([
        'path' => $path,
        'size_id' => 2,
        'todo_id' => $todo->id
      ]);

      $tmpImgPath = createPreviewImage(storage_path("app/public/$path"));

      $path = Storage::disk('public')->putFile('', new File($tmpImgPath));

      Image::create([
        'path' => $path,
        'size_id' => 1,
        'todo_id' => $todo->id
      ]);
    }
}
