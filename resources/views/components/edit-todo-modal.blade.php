<div class="modal fade" id="edit-todo-modal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Todo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <input class="form-control mb-3" type="text" placeholder="Todo text" aria-label="Text" id="todo-text">

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
    </div>
  </div>
</div>


<script>
  const editTodoModal = document.getElementById('edit-todo-modal');
  const $editTodoModal = $("#edit-todo-modal");

  const todoTextEl = document.getElementById('todo-text');

  const addTagButton = document.getElementById('add-tag-button');
  const todoTagInput = document.getElementById('todo-tag-input');
  const tagsContainer = document.getElementById('tags-container');
  addTagButton.onclick = () => {
    tagsContainer.append(window.todo.createTagBadge(todoTagInput.value, true));
    todoTagInput.value = '';
  }

  const saveButton = document.getElementById('save-todo');

  const todosContainer = document.getElementById('todos');
  todosContainer.addEventListener('click', async function(e) {
    console.log('target: ', e.target);

    if(!e.target.classList.contains('edit-button')) {
      return;
    }

    const todoId = e.target.closest(".card").dataset.id;

    const { data } = await axios.get(`/todos/${todoId}`);
    console.log("data: ", data);

    const editTodoEvent = new CustomEvent("edit-todo", {
        detail: {
            todoId,
            text: data.text,
            tags: data.tags,
        },
    });

    editTodoModal.dispatchEvent(editTodoEvent);
  })

  editTodoModal.addEventListener('edit-todo', editTodo);

  function editTodo(e) {
    todoTextEl.value = e.detail.text;
    e.detail.tags.forEach(tag => {
      tagsContainer.append(window.todo.createTagBadge(tag, true))
    });

    saveButton.onclick = () => {
      saveCorrectedTodo(e.detail.todoId);
    }

    $editTodoModal.modal("show");
  }


  const newTodoButton = document.getElementById('new-todo-button');
  newTodoButton.onclick = () => {
    editTodoModal.dispatchEvent(new CustomEvent("new-todo"));
  }

  editTodoModal.addEventListener('new-todo', newTodo);

  function newTodo(e) {
    saveButton.onclick = saveNewTodo;

    $editTodoModal.modal("show");
  }


  async function saveNewTodo() {
    const { data } = await axios.post('/todos', {
      text: todoTextEl.value,
      tags: getTags(),
    });

    console.log('data: ', data);

    // window.todo.add(data);
    window.todo.createCard(data);

    $editTodoModal.modal("hide");
  }

  async function saveCorrectedTodo(todoId) {
    const { data } = await axios.patch(`/todos/${todoId}`, {
      text: todoTextEl.value,
    });

    console.log('data: ', data);

    window.todo.replaceContent(data);

    $editTodoModal.modal("hide");
  }

  function getTags() {
    const tagsArray = [];
    editTodoModal.querySelectorAll('.tag-text').forEach(tagText => {
      tagsArray.push(tagText.textContent);
    });

    return tagsArray;
  }

  editTodoModal.addEventListener('hidden.bs.modal', event => {
    todoTextEl.value = '';
    tagsContainer.innerHTML = '';
  })
</script>