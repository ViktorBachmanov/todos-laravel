import { createTagBadge } from "./tag-badge";

const tagsContainer = document.getElementById("tags-filter-container");
const tagsInput = document.getElementById("tags-filter-input");
const addTagButton = document.getElementById("tags-filter-add-button");
addTagButton.onclick = () => {
    tagsContainer.append(createTagBadge(tagsInput.value, true));
    tagsInput.value = "";
};
