let darkmode = localStorage.getItem("darkmode");
const darkmodeToggle = document.querySelector("#darkmode");
const darkmodeLogo = document.getElementById("darkmode");
const logo_admin = document.getElementById("logo_admin");
const enableDarkMode = () => {
    document.body.classList.add('darkmode');
    localStorage.setItem("darkmode", "enabled");
    darkmodeLogo.style.transform = "rotate(180deg)";
    darkmodeLogo.style.transition = "0.5s";
    logo_admin.style.fill = "white";
};
const disableDarkMode = () => {
    document.body.classList.remove('darkmode');
    localStorage.setItem("darkmode", null);
    darkmodeLogo.style.transform = "rotate(0deg)";
    darkmodeLogo.style.transition = "0.5s";
    logo_admin.style.fill = "black";
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