<div class="modal fade" id="edit-todo-modal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Edit Todo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input class="form-control" type="text" placeholder="Todo" aria-label="Todo text" id="todo-text">
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

  const saveButton = document.getElementById('save-todo');

  saveButton.onclick = async function() {
    const { data } = await axios.post('/todos', {
      text: document.getElementById('todo-text').value,
    });

    console.log('data: ', data);

    window.todo.add(data);

    $editTodoModal.modal("hide");
  }

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
            text: data.text,
        },
    });

    editTodoModal.dispatchEvent(editTodoEvent);
  })

  editTodoModal.addEventListener('edit-todo', editTodo);

  function editTodo(e) {
    const todoTextEl = document.getElementById('todo-text');
    todoTextEl.value = e.detail.text;

    $editTodoModal.modal("show");
  }


  const newTodoButton = document.getElementById('new-todo-button');
  newTodoButton.onclick = () => {
    editTodoModal.dispatchEvent(new CustomEvent("new-todo"));
  }

  editTodoModal.addEventListener('new-todo', newTodo);

  function newTodo(e) {
    const todoTextEl = document.getElementById('todo-text');
    todoTextEl.value = '';

    $editTodoModal.modal("show");
  }
</script>