<x-layout>
  <div id="todos">
     @foreach ($todos as $todo)
      <div class="card" data-id="{{ $todo->id }}">{{ $todo->text }}</div>
     @endforeach
  </div>

  <x-edit-todo-modal />
</x-layout>