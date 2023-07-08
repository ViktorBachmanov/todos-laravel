const logoutButton = document.getElementById("logout-button");
if (logoutButton) {
    logoutButton.onclick = async () => {
        await axios.post("/logout");
        location.reload(true);
    };
}

const toggleThemeButton = document.getElementById("toggle-theme-button");
toggleThemeButton.onclick = () => {
    const htmlEl = document.documentElement;
    const theme = htmlEl.getAttribute("data-bs-theme");
    switch (theme) {
        case "light":
        default:
            htmlEl.setAttribute("data-bs-theme", "dark");
            break;
        case "dark":
            htmlEl.setAttribute("data-bs-theme", "light");
            break;
    }
};
