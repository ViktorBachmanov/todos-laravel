<x-layout>
  <div id="todos">
     @foreach ($todos as $todo)
      <x-todo-card :todo="$todo" />
     @endforeach
  </div>

  <x-edit-todo-modal />

  <script src="{{ mix('/js/edit-todo-modal.js') }}"></script>
  <script src="{{ mix('/js/tags-filter.js') }}"></script>
</x-layout>