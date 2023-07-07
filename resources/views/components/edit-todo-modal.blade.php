<div class="modal fade" id="edit-todo-modal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Todo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <input class="form-control mb-3" type="text" placeholder="Todo text" aria-label="Text" id="todo-text">

        <div id="todo-image"></div>

        <div class="mb-3">
          <label for="todo-image-input" class="form-label">Изображение</label>
          <input class="form-control" type="file" id="todo-image-input" accept="image/*">
        </div>

        <div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tag" id="todo-tag-input" aria-label="Todo's tag" aria-describedby="add-tag-button">
            <button class="btn btn-outline-secondary" type="button" id="add-tag-button">Add tag</button>
          </div>
          <div id="tags-container"></div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-todo">Save</button>
      </div>

      <div id="edit-todo-modal-spinner">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</div>
