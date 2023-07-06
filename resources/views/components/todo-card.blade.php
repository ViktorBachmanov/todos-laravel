<div class="card todo-card" data-id="{{ $todo->id }}">
  <div class="todo-content">
    <div class="todo-content__image"></div>
    <div>
      {{ $todo->text }}
    </div>
    <button class="btn btn-primary edit-button">
      <i class="bi bi-pencil"></i>
    </button>
  </div>
</div>