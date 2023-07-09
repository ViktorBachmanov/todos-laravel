<x-layout>
  <div style="padding: 1em; display: flex; column-gap: 2em;">
    <x-tags-filter :check="$filterTagsCheck" :tags="$filterTags" />

    <div id="todos">
      @foreach ($todos as $todo)
        <x-todo-card :todo="$todo" />
      @endforeach
    </div>
  </div>

  <x-edit-todo-modal />

  <script src="{{ mix('/js/edit-todo-modal.js') }}"></script>
  <script src="{{ mix('/js/tags-filter.js') }}"></script>
  <script src="{{ mix('/js/todos.js') }}"></script>
</x-layout>