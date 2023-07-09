import { createTagBadge } from "./tag-badge";

function createCard(data) {
    const todoCard = document.createElement("div");
    todoCard.setAttribute("class", "card todo-card");
    todoCard.dataset.id = data.id;

    todoCard.append(createContent(data));

    return todoCard;
}

function createContent(data) {
    const todoContent = document.createElement("div");
    todoContent.classList.add("todo-content");

    const todoText = document.createElement("div");
    todoText.setAttribute("class", "todo-text");
    todoText.textContent = data.text;
    todoContent.append(todoText);

    if (data.previewImage && data.fullImage) {
        const todoImage = document.createElement("img");
        todoImage.classList.add("todo-content__image");
        todoImage.src = `/storage/${data.previewImage.path}`;
        const todoImageAnchor = document.createElement("a");
        todoImageAnchor.setAttribute("target", "_blank");
        todoImageAnchor.href = `/storage/${data.fullImage.path}`;
        todoImageAnchor.append(todoImage);

        todoContent.append(todoImageAnchor);
    }

    const tagsContainer = document.createElement("div");
    tagsContainer.setAttribute("class", "todo-card__tags");
    data.tags.forEach((tag) => {
        tagsContainer.append(createTagBadge(tag));
    });
    todoContent.append(tagsContainer);

    const buttonsContainer = document.createElement("div");
    buttonsContainer.setAttribute("class", "todo-card__buttons");

    const editButton = document.createElement("button");
    editButton.setAttribute("class", "btn btn-primary edit-button");

    const editIcon = document.createElement("i");
    editIcon.setAttribute("class", "bi bi-pencil");
    editButton.append(editIcon);

    const deleteButton = document.createElement("button");
    deleteButton.setAttribute("class", "btn btn-secondary delete-button");

    const deleteIcon = document.createElement("i");
    deleteIcon.setAttribute("class", "bi bi-x-square");
    deleteButton.append(deleteIcon);

    buttonsContainer.append(editButton);
    buttonsContainer.append(deleteButton);

    todoContent.append(buttonsContainer);

    return todoContent;
}

function replaceContent(data) {
    const todoCard = document.querySelector(`.todo-card[data-id="${data.id}"]`);
    todoCard.innerHTML = "";
    todoCard.append(createContent(data));
}

async function deleteTodo(todoId) {
    const { data } = await axios.post(`/todos/${todoId}`, {
        _method: "DELETE",
    });

    return data;
}

export { createCard, createTagBadge, replaceContent, deleteTodo };
