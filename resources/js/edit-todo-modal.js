import { createCard, replaceContent } from "./todo-card.js";
import { createTagBadge, getTags } from "./tag-badge";

const editTodoModal = document.getElementById("edit-todo-modal");
const $editTodoModal = $("#edit-todo-modal");

const spinner = document.getElementById("edit-todo-modal-spinner");

const todos = document.getElementById("todos");

const todoTextEl = document.getElementById("todo-text");

const todoImageContainer = document.getElementById("todo-image");
const todoFileInput = document.getElementById("todo-image-input");

const addTagButton = document.getElementById("add-tag-button");
const todoTagInput = document.getElementById("todo-tag-input");
const tagsContainer = document.getElementById("tags-container");
addTagButton.onclick = () => {
    tagsContainer.append(createTagBadge(todoTagInput.value, true));
    todoTagInput.value = "";
};

const saveButton = document.getElementById("save-todo");

//================== New Todo =================================

const newTodoButton = document.getElementById("new-todo-button");
newTodoButton.onclick = () => {
    saveButton.onclick = saveNewTodo;

    $editTodoModal.modal("show");
};

async function saveNewTodo() {
    if (todoTextEl.value === "") {
        todoTextEl.classList.add("is-invalid");
        return;
    }

    spinner.style.opacity = 1;

    const { data } = await axios.postForm("/todos", createPostBody());

    todos.append(createCard(data));

    $editTodoModal.modal("hide");
}

//================== Edit Todo ==================================

export async function showEditTodoModal(todoId) {
    saveButton.onclick = () => {
        saveCorrectedTodo(todoId);
    };

    spinner.style.opacity = 1;
    $editTodoModal.modal("show");

    const { data } = await axios.get(`/todos/${todoId}`);

    spinner.style.opacity = 0;

    todoTextEl.value = data.text;
    data.tags.forEach((tag) => {
        tagsContainer.append(createTagBadge(tag, true));
    });

    tagsContainer.addEventListener("click", (e) => {
        if (e.target.classList.contains("tag-close-button")) {
            e.target.parentNode.remove();
        }
    });

    if (data.previewImage) {
        const todoImage = document.createElement("img");
        todoImage.src = `/storage/${data.previewImage.path}`;
        todoImageContainer.append(todoImage);

        const deleteImageButton = document.createElement("button");
        deleteImageButton.setAttribute("class", "btn btn-secondary ms-2");
        deleteImageButton.textContent = "Delete image";
        deleteImageButton.onclick = () => (todoImageContainer.innerHTML = "");

        todoImageContainer.append(deleteImageButton);
    }
}

async function saveCorrectedTodo(todoId) {
    if (todoTextEl.value === "") {
        todoTextEl.classList.add("is-invalid");
        return;
    }

    spinner.style.opacity = 1;

    const { data } = await axios.postForm(`/todos/${todoId}`, {
        ...createPostBody(),
        _method: "PATCH",
        delete_image: todoImageContainer.innerHTML === "" ? true : null,
    });

    replaceContent(data);

    $editTodoModal.modal("hide");
}

//=======================================================

function createPostBody() {
    return {
        text: todoTextEl.value,
        tags: getTags(editTodoModal),
        image: todoFileInput.files[0],
    };
}

editTodoModal.addEventListener("hidden.bs.modal", (event) => {
    todoTextEl.value = "";
    tagsContainer.innerHTML = "";
    todoImageContainer.innerHTML = "";
    spinner.style.opacity = 0;
    todoFileInput.value = "";
    todoTextEl.classList.remove("is-invalid");
});
