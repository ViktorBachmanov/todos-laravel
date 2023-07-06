function createCard(data) {
    const todoCard = document.createElement("div");
    todoCard.setAttribute("class", "card todo-card");
    todoCard.dataset.id = data.id;

    todoCard.append(createContent(data.text));

    const todos = document.getElementById("todos");
    todos.append(todoCard);
}

function createContent(text) {
    const todoContent = document.createElement("div");
    todoContent.classList.add("todo-content");

    const todoImage = document.createElement("div");
    todoImage.classList.add("todo-content__image");
    todoContent.append(todoImage);

    const todoText = document.createElement("div");
    todoText.textContent = text;
    todoContent.append(todoText);

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
    todoCard.append(createContent(data.text));
}

function createTagBadge(text, closeButton = false) {
    const badge = document.createElement("span");
    badge.setAttribute("class", "badge rounded-pill text-bg-secondary mx-1");
    // badge.textContent = text;
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

// module.exports.add = createTodoCard;
module.exports = { createCard, replaceContent, createTagBadge };
