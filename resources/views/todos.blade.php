<x-layout>
  <div id="todos">
     @foreach ($todos as $todo)
      <x-todo-card :todo="$todo" />
     @endforeach
  </div>

  <x-edit-todo-modal />
</x-layout>