function createCard(data) {
    const todoCard = document.createElement("div");
    todoCard.setAttribute("class", "card todo-card");
    todoCard.dataset.id = data.id;

    todoCard.append(createContent(data));

    // const todos = document.getElementById("todos");
    // todos.append(todoCard);

    return todoCard;
}

function createContent(data) {
    const todoContent = document.createElement("div");
    todoContent.classList.add("todo-content");

    const todoText = document.createElement("div");
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

    const editButton = document.createElement("button");
    editButton.setAttribute("class", "btn btn-primary edit-button");

    const editIcon = document.createElement("i");
    editIcon.setAttribute("class", "bi bi-pencil");
    editButton.append(editIcon);

    todoContent.append(editButton);

    return todoContent;
}

function replaceContent(data) {
    console.log("replaceTodoContent");

    const todoCard = document.querySelector(`.todo-card[data-id="${data.id}"]`);
    todoCard.innerHTML = "";
    todoCard.append(createContent(data));
}

function createTagBadge(text, closeButton = false) {
    const badge = document.createElement("span");
    badge.setAttribute("class", "badge rounded-pill text-bg-secondary mx-1");
    const badgeText = document.createElement("span");
    badgeText.textContent = text;
    badgeText.setAttribute("class", "fs-6 tag-text");
    badge.append(badgeText);

    if (closeButton) {
        const closeButton = document.createElement("button");
        closeButton.setAttribute("class", "btn-close ms-1");
        closeButton.setAttribute("aria-label", "Remove tag");
        closeButton.onclick = () => badge.remove();
        badge.append(closeButton);
    }

    return badge;
}

export { createCard, createTagBadge, replaceContent };
