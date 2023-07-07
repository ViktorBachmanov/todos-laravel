import { createCard, createTagBadge, replaceContent } from "./todo-card.js";

const editTodoModal = document.getElementById("edit-todo-modal");
const $editTodoModal = $("#edit-todo-modal");

const spinner = document.getElementById("edit-todo-modal-spinner");

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
    spinner.style.opacity = 1;

    const { data } = await axios.postForm("/todos", createPostBody());

    console.log("data: ", data);

    createCard(data);

    $editTodoModal.modal("hide");
}

//================== Edit Todo ==================================

const todosContainer = document.getElementById("todos");
todosContainer.addEventListener("click", async function (e) {
    console.log("target: ", e.target);

    if (!e.target.classList.contains("edit-button")) {
        return;
    }

    saveButton.onclick = () => {
        saveCorrectedTodo(todoId);
    };

    spinner.style.opacity = 1;
    $editTodoModal.modal("show");

    const todoId = e.target.closest(".card").dataset.id;

    const { data } = await axios.get(`/todos/${todoId}`);

    spinner.style.opacity = 0;

    console.log("data: ", data);

    todoTextEl.value = data.text;
    data.tags.forEach((tag) => {
        tagsContainer.append(createTagBadge(tag, true));
    });

    if (data.previewImage) {
        const todoImage = document.createElement("img");
        todoImage.src = `/storage/${data.previewImage.path}`;
        todoImageContainer.append(todoImage);
    }
});

async function saveCorrectedTodo(todoId) {
    spinner.style.opacity = 1;

    const { data } = await axios.postForm(`/todos/${todoId}`, {
        ...createPostBody(),
        _method: "PATCH",
    });

    console.log("data: ", data);

    replaceContent(data);

    $editTodoModal.modal("hide");
}

//=======================================================

function createPostBody() {
    return {
        text: todoTextEl.value,
        tags: getTags(),
        image: todoFileInput.files[0],
    };
}

function getTags() {
    const tagsArray = [];
    editTodoModal.querySelectorAll(".tag-text").forEach((tagText) => {
        tagsArray.push(tagText.textContent);
    });

    return tagsArray;
}

editTodoModal.addEventListener("hidden.bs.modal", (event) => {
    todoTextEl.value = "";
    tagsContainer.innerHTML = "";
    todoImageContainer.innerHTML = "";
    spinner.style.opacity = 0;
});
