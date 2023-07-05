function addTodo(text) {
    const todo = document.createElement("div");
    todo.classList.add("card");
    todo.textContent = text;

    const todos = document.getElementById("todos");
    todos.append(todo);
}

module.exports.add = addTodo;
