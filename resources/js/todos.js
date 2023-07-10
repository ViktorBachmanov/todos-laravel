import { deleteTodo } from "./todo-card";
import editTodoModal from "./edit-todo-modal";

import toast from "./toast";

const todosContainer = document.getElementById("todos");

todosContainer.addEventListener("click", async function (e) {
    const todoCard = e.target.closest(".todo-card");
    const todoId = todoCard.dataset.id;

    if (e.target.classList.contains("edit-button")) {
        editTodoModal.showForEdit(todoId);
    } else if (e.target.classList.contains("delete-button")) {
        try {
            await deleteTodo(todoId);

            toast.show("Todo deleted", "success");

            todoCard.remove();
        } catch {
            toast.show("Error", "danger");
        }
    }
});

const newTodoButton = document.getElementById("new-todo-button");
newTodoButton.onclick = () => {
    editTodoModal.showForNew();
};
