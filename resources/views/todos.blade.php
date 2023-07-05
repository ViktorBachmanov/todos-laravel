<x-layout>
  <div id="todos">
     @foreach ($todos as $todo)
      <div class="card" data-id="{{ $todo->id }}">
        <div class="todo-content">
          {{ $todo->text }}
          <button class="btn btn-primary edit-button">
            <i class="bi bi-pencil"></i>
          </button>
        </div>
      </div>
     @endforeach
  </div>

  <x-edit-todo-modal />
</x-layout>