const aboutMenu = document.getElementById("aboutMenu")
const mainForm = document.getElementById("mainForm")

// a function that toggles the about menu in index.php
function toggleAboutMenu() {
    if (aboutMenu.classList.contains("hidden")) {
        aboutMenu.classList.remove("hidden")
        mainForm.classList.add("hidden")

    } else {
        aboutMenu.classList.add("hidden")
        mainForm.classList.remove("hidden")
    }
}