function createTodoCard(data) {
    const todoCard = document.createElement("div");
    todoCard.classList.add("card");
    todoCard.dataset.id = data.id;

    todoCard.append(createTodoContent(data.text));

    const todos = document.getElementById("todos");
    todos.append(todoCard);
}

function createTodoContent(text) {
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
    editButton.onclick = async (e) => {
        const todoId = e.target.closest(".card").dataset.id;

        const { data } = await axios.get(`/todos/${todoId}`);
        console.log("data: ", data);
    };
    const editIcon = document.createElement("i");
    editIcon.setAttribute("class", "bi bi-pencil");
    editButton.append(editIcon);

    todoContent.append(editButton);

    return todoContent;
}

module.exports.add = createTodoCard;
