import { createCard, replaceContent } from "./todo-card.js";
import { createTagBadge, getTags } from "./tag-badge";
import toast from "./toast.js";

const todosContainer = document.getElementById("todos");

class EditTodoModal {
    constructor() {
        this.spinner = document.getElementById("edit-todo-modal-spinner");
        this.todoTextEl = document.getElementById("todo-text");
        this.todoImageContainer = document.getElementById("todo-image");
        this.todoFileInput = document.getElementById("todo-image-input");
        this.addTagButton = document.getElementById("add-tag-button");
        this.todoTagInput = document.getElementById("todo-tag-input");
        this.tagsContainer = document.getElementById("tags-container");
        this.saveButton = document.getElementById("save-todo");
        this.elem = document.getElementById("edit-todo-modal");
        this.instance = new bootstrap.Modal(this.elem);

        this.saveNewTodo = this.saveNewTodo.bind(this);
        this.saveCorrectedTodo = this.saveCorrectedTodo.bind(this);

        this.registerListeners();
    }

    registerListeners() {
        this.elem.addEventListener("hidden.bs.modal", (event) => {
            this.todoTextEl.value = "";
            this.tagsContainer.innerHTML = "";
            this.todoImageContainer.innerHTML = "";
            this.spinner.style.opacity = 0;
            this.todoFileInput.value = "";
            this.todoTextEl.classList.remove("is-invalid");
        });

        this.todoFileInput.addEventListener("change", (e) => {
            if (!e.target.files.length) {
                return;
            }

            const img = document.createElement("img");
            img.setAttribute("class", "selected-image");
            img.src = URL.createObjectURL(e.target.files[0]);

            img.onload = () => {
                URL.revokeObjectURL(img.src);
            };
            this.todoImageContainer.innerHTML = "";
            this.todoImageContainer.append(img);
        });

        this.tagsContainer.addEventListener("click", (e) => {
            if (e.target.classList.contains("tag-close-button")) {
                e.target.parentNode.remove();
            }
        });

        this.addTagButton.onclick = () => {
            this.tagsContainer.append(
                createTagBadge(this.todoTagInput.value, true)
            );
            this.todoTagInput.value = "";
        };
    }

    showForNew() {
        this.saveButton.onclick = this.saveNewTodo;
        this.instance.show();
    }

    async saveNewTodo() {
        if (this.todoTextEl.value === "") {
            this.todoTextEl.classList.add("is-invalid");
            return;
        }

        this.spinner.style.opacity = 1;

        try {
            const { data } = await axios.postForm(
                "/todos",
                this.createPostBody()
            );
            toast.show("Todo saved", "success");
            this.instance.hide();
            todosContainer.append(createCard(data));
        } catch (error) {
            toast.show("Error", "danger");
            this.spinner.style.opacity = 0;
        }
    }

    async showForEdit(todoId) {
        this.saveButton.onclick = () => {
            this.saveCorrectedTodo(todoId);
        };

        this.spinner.style.opacity = 1;
        this.instance.show();

        const { data } = await axios.get(`/todos/${todoId}`);
        this.spinner.style.opacity = 0;

        this.todoTextEl.value = data.text;
        data.tags.forEach((tag) => {
            this.tagsContainer.append(createTagBadge(tag, true));
        });

        if (data.previewImage) {
            const todoImage = document.createElement("img");
            todoImage.src = `/storage/${data.previewImage.path}`;
            this.todoImageContainer.append(todoImage);

            const deleteImageButton = document.createElement("button");
            deleteImageButton.setAttribute("class", "btn btn-secondary ms-2");
            deleteImageButton.textContent = "Delete image";
            deleteImageButton.onclick = () =>
                (this.todoImageContainer.innerHTML = "");

            this.todoImageContainer.append(deleteImageButton);
        }
    }

    async saveCorrectedTodo(todoId) {
        if (this.todoTextEl.value === "") {
            this.todoTextEl.classList.add("is-invalid");
            return;
        }

        this.spinner.style.opacity = 1;

        try {
            const { data } = await axios.postForm(`/todos/${todoId}`, {
                ...this.createPostBody(),
                _method: "PATCH",
                delete_image:
                    this.todoImageContainer.innerHTML === "" ? true : null,
            });

            toast.show("Todo saved", "success");

            this.instance.hide();

            replaceContent(data);
        } catch {
            toast.show("Error", "danger");
            this.spinner.style.opacity = 0;
        }
    }

    createPostBody() {
        return {
            text: this.todoTextEl.value,
            tags: getTags(this.tagsContainer),
            image: this.todoFileInput.files[0],
        };
    }
}

const editTodoModal = new EditTodoModal();

export default editTodoModal;
