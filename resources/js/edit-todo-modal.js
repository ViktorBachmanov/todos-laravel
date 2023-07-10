import { createCard, replaceContent } from "./todo-card.js";
import { createTagBadge, getTags } from "./tag-badge";
import toast from "./toast.js";

const todosContainer = document.getElementById("todos");

class EditTodoModal {
    constructor() {
        this.spinner = document.getElementById("edit-todo-modal-spinner");
        this.textEl = document.getElementById("todo-text");
        this.imageContainer = document.getElementById("todo-image");
        this.fileInput = document.getElementById("todo-image-input");
        this.addTagButton = document.getElementById("add-tag-button");
        this.tagInput = document.getElementById("todo-tag-input");
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
            this.textEl.value = "";
            this.tagsContainer.innerHTML = "";
            this.imageContainer.innerHTML = "";
            this.spinner.style.opacity = 0;
            this.fileInput.value = "";
            this.textEl.classList.remove("is-invalid");
        });

        this.fileInput.addEventListener("change", (e) => {
            if (!e.target.files.length) {
                return;
            }

            const img = document.createElement("img");
            img.setAttribute("class", "selected-image");
            img.src = URL.createObjectURL(e.target.files[0]);

            img.onload = () => {
                URL.revokeObjectURL(img.src);
            };
            this.imageContainer.innerHTML = "";
            this.imageContainer.append(img);
        });

        this.tagsContainer.addEventListener("click", (e) => {
            if (e.target.classList.contains("tag-close-button")) {
                e.target.parentNode.remove();
            }
        });

        this.addTagButton.onclick = () => {
            this.tagsContainer.append(
                createTagBadge(this.tagInput.value, true)
            );
            this.tagInput.value = "";
        };
    }

    showForNew() {
        this.saveButton.onclick = this.saveNewTodo;
        this.instance.show();
    }

    async saveNewTodo() {
        if (this.textEl.value === "") {
            this.textEl.classList.add("is-invalid");
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

        this.textEl.value = data.text;
        data.tags.forEach((tag) => {
            this.tagsContainer.append(createTagBadge(tag, true));
        });

        if (data.previewImage) {
            const todoImage = document.createElement("img");
            todoImage.src = `/storage/${data.previewImage.path}`;
            this.imageContainer.append(todoImage);

            const deleteImageButton = document.createElement("button");
            deleteImageButton.setAttribute("class", "btn btn-secondary ms-2");
            deleteImageButton.textContent = "Delete image";
            deleteImageButton.onclick = () =>
                (this.imageContainer.innerHTML = "");

            this.imageContainer.append(deleteImageButton);
        }
    }

    async saveCorrectedTodo(todoId) {
        if (this.textEl.value === "") {
            this.textEl.classList.add("is-invalid");
            return;
        }

        this.spinner.style.opacity = 1;

        try {
            const { data } = await axios.postForm(`/todos/${todoId}`, {
                ...this.createPostBody(),
                _method: "PATCH",
                delete_image:
                    this.imageContainer.innerHTML === "" ? true : null,
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
            text: this.textEl.value,
            tags: getTags(this.tagsContainer),
            image: this.fileInput.files[0],
        };
    }
}

const editTodoModal = new EditTodoModal();

export default editTodoModal;
