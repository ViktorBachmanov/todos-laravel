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
  const saveButton = document.getElementById('save-todo');

  saveButton.onclick = async function() {
    const { data } = await axios.post('/todo', {
      text: document.getElementById('todo-text').value,
    });

    console.log('data: ', data);

    window.todo.add(data.text);

    // const modal = new window.bootstrap.Modal(document.getElementById('edit-todo-modal'));
    // modal.toggle();
    $("#edit-todo-modal").modal("hide");
  }
</script>