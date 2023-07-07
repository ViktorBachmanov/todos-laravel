import { createCard } from "./todo-card.js";

const filterTagsButton = document.getElementById("filter-tags-button");
const tagsFilterInput = document.getElementById("tags-filter-input");

const todosContainer = document.getElementById("todos");

filterTagsButton.onclick = async () => {
    const tagsString = tagsFilterInput.value;
    const tagsArr = tagsString.split(",");

    console.log("tags", tagsArr);

    const { data } = await axios.post("/get-filtered-todos", { tags: tagsArr });

    todosContainer.innerHTML = "";

    data.forEach((todoData) => {
        console.log("data.forEach");
        todosContainer.append(createCard(todoData));
    });

    // $.ajax({
    //     headers: {
    //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //     },
    //     url: "/todos",
    //     method: "GET",
    //     data: { tags: tagsArr },
    // });
};
