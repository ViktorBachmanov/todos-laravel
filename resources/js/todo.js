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
    todoContent.textContent = text;

    const editButton = document.createElement("button");
    editButton.setAttribute("class", "btn btn-primary");
    editButton.textContent = "Edit";
    editButton.style.maxWidth = "5em";
    editButton.onclick = async (e) => {
        const todoId = e.target.closest(".card").dataset.id;

        const { data } = await axios.get(`/todo/${todoId}`);
        console.log("data: ", data);
    };

    todoContent.append(editButton);

    return todoContent;
}

module.exports.add = createTodoCard;
