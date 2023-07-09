import { createTagBadge, getTags } from "./tag-badge";

const tagsContainer = document.getElementById("tags-filter-container");
const tagsInput = document.getElementById("tags-filter-input");
const addTagButton = document.getElementById("tags-filter-add-button");
addTagButton.onclick = () => {
    tagsContainer.append(createTagBadge(tagsInput.value, true));
    tagsInput.value = "";

    updateTagsCookie();
};

tagsContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("tag-close-button")) {
        e.target.parentNode.remove();

        updateTagsCookie();
    }
});

function updateTagsCookie() {
    const tags = getTags(tagsContainer);

    document.cookie = `tags=${JSON.stringify(tags)}; path=/; samesite=lax;`;
}
