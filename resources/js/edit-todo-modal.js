const editTodoModal = document.getElementById("edit-todo-modal");
const $editTodoModal = $("#edit-todo-modal");

const todoTextEl = document.getElementById("todo-text");

const todoImageContainer = document.getElementById("todo-image");
const todoFileInput = document.getElementById("todo-image-input");

const addTagButton = document.getElementById("add-tag-button");
const todoTagInput = document.getElementById("todo-tag-input");
const tagsContainer = document.getElementById("tags-container");
addTagButton.onclick = () => {
    tagsContainer.append(window.todo.createTagBadge(todoTagInput.value, true));
    todoTagInput.value = "";
};

const saveButton = document.getElementById("save-todo");

const todosContainer = document.getElementById("todos");
todosContainer.addEventListener("click", async function (e) {
    console.log("target: ", e.target);

    if (!e.target.classList.contains("edit-button")) {
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
            previewImage: data.previewImage,
        },
    });

    editTodoModal.dispatchEvent(editTodoEvent);
});

editTodoModal.addEventListener("edit-todo", editTodo);

function editTodo(e) {
    todoTextEl.value = e.detail.text;
    e.detail.tags.forEach((tag) => {
        tagsContainer.append(window.todo.createTagBadge(tag, true));
    });

    if (e.detail.previewImage) {
        const todoImage = document.createElement("img");
        todoImage.src = `/storage/${e.detail.previewImage.path}`;
        todoImageContainer.append(todoImage);
    }

    saveButton.onclick = () => {
        saveCorrectedTodo(e.detail.todoId);
    };

    $editTodoModal.modal("show");
}

const newTodoButton = document.getElementById("new-todo-button");
newTodoButton.onclick = () => {
    editTodoModal.dispatchEvent(new CustomEvent("new-todo"));
};

editTodoModal.addEventListener("new-todo", newTodo);

function newTodo(e) {
    saveButton.onclick = saveNewTodo;

    $editTodoModal.modal("show");
}

async function saveNewTodo() {
    const { data } = await axios.postForm("/todos", {
        text: todoTextEl.value,
        tags: getTags(),
        image: todoFileInput.files[0],
    });

    console.log("data: ", data);

    window.todo.createCard(data);

    $editTodoModal.modal("hide");
}

async function saveCorrectedTodo(todoId) {
    const { data } = await axios.patch(`/todos/${todoId}`, {
        text: todoTextEl.value,
        tags: getTags(),
    });

    console.log("data: ", data);

    window.todo.replaceContent(data);

    $editTodoModal.modal("hide");
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
});
