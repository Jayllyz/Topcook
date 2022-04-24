function changeType() {
    let selectedType = document.getElementById("selectedType");
    let selectedTypeValue = selectedType.options[selectedType.selectedIndex].value;

    if (selectedTypeValue) {
        const request = new XMLHttpRequest();
        request.open("GET", "recipes/selectedTypeRecipe.php?typeRecipe=" + selectedTypeValue);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                const resType = request.responseText;
                if (selectedTypeValue !== "----Choisir une option de tri----") {
                    document.getElementById("recettes").style.display = "none";
                    document.getElementById("selectRecipeView").innerHTML = resType;
                }else{
                    document.getElementById("recettes").style.display = "block";
                    document.getElementById("selectRecipeView").innerHTML = "";
                }
            }
        };
        request.send();
    }
}