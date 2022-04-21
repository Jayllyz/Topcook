let darkmode = localStorage.getItem("darkmode");
const darkmodeToggle = document.querySelector("#darkmode");
const enableDarkMode = () => {
    document.body.classList.add('darkmode');
    localStorage.setItem("darkmode", "enabled");
};
const disableDarkMode = () => {
    document.body.classList.remove('darkmode');
    localStorage.setItem("darkmode", null);
};

if (darkmode === "enabled") {
    enableDarkMode();
}
darkmodeToggle.addEventListener("click", () => {
    darkmode = localStorage.getItem("darkmode");
    if (darkmode !== "enabled") {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
});