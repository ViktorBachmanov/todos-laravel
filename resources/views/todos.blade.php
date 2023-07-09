<x-layout>
  <div style="padding: 1em; display: flex; column-gap: 2em;">
    <x-tags-filter :check="$filterTagsCheck" :tags="$filterTags" />

    <div>
      @if($search)
        <div class="fs-3 mb-4" style="display: flex; align-items: center; justify-content: center; column-gap: 1em">
          Результаты поиска для "{{ $search }}"
          <button type="button" class="btn btn-secondary" id="reset-search-button" onclick="location.href = '/'">Reset</button>
        </div>
      @endif

      <div id="todos">
        @foreach ($todos as $todo)
          <x-todo-card :todo="$todo" />
        @endforeach
      </div>
    </div>
  </div>

  <x-edit-todo-modal />

  <script src="{{ mix('/js/edit-todo-modal.js') }}"></script>
  <script src="{{ mix('/js/tags-filter.js') }}"></script>
  <script src="{{ mix('/js/search.js') }}"></script>
  <script src="{{ mix('/js/todos.js') }}"></script>
</x-layout>