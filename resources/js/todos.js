import { showEditTodoModal } from "./edit-todo-modal";
import { deleteTodo } from "./todo-card";

const todosContainer = document.getElementById("todos");

todosContainer.addEventListener("click", async function (e) {
    const todoCard = e.target.closest(".todo-card");
    const todoId = todoCard.dataset.id;

    if (e.target.classList.contains("edit-button")) {
        showEditTodoModal(todoId);
    } else if (e.target.classList.contains("delete-button")) {
        const result = await deleteTodo(todoId);

        if (result === 1) {
            todoCard.remove();
        }
    }
});
