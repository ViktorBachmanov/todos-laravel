const tagTextClass = "tag-text";

export function createTagBadge(text, closeButton = false) {
    const badge = document.createElement("span");
    badge.setAttribute("class", "badge rounded-pill text-bg-secondary mx-1");
    const badgeText = document.createElement("span");
    badgeText.textContent = text;
    badgeText.setAttribute("class", `fs-6 ${tagTextClass}`);
    badge.append(badgeText);

    if (closeButton) {
        const closeButton = document.createElement("button");
        closeButton.setAttribute("class", "btn-close ms-1 tag-close-button");
        closeButton.setAttribute("aria-label", "Remove tag");
        // closeButton.onclick = () => badge.remove();
        badge.append(closeButton);
    }

    return badge;
}

export function getTags(tagsContainer) {
    const tagsArray = [];
    tagsContainer.querySelectorAll(`.${tagTextClass}`).forEach((tagText) => {
        tagsArray.push(tagText.textContent);
    });

    return tagsArray;
}
