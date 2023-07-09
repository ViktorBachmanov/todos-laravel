const searchInput = document.getElementById("search-input");
const searchButton = document.getElementById("search-button");

searchButton.onclick = () => {
    location.search = `?search=${searchInput.value}`;
};
