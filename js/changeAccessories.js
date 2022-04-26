
function changeTypeAccessories(){
    const chooseElement = document.getElementById('chooseElement');
    const viewSelectedElement = document.getElementById('viewSelectedElement');
    let selectedType = document.getElementById("selectedTypeAccessories");
    let selectedTypeValue = selectedType.options[selectedType.selectedIndex].value;
    const btn_delete = document.getElementById('btn_delete');
    const eyes = document.getElementById("eyes-presentation");
    const hair = document.getElementById("hair-presentation");
    const mouth = document.getElementById("mouth-presentation");
    const beard = document.getElementById("beard-presentation");
    const hat = document.getElementById("hat-presentation");
    const sweat = document.getElementById("sweat-presentation");

    if (selectedTypeValue) {
        const request = new XMLHttpRequest();
        request.open("GET", "https://topcook.site/avatar/selectedTypeAccessories.php?type=" + selectedTypeValue);
        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                const resType = request.responseText;
                if (selectedTypeValue !== "Choisir un type d'accessoire") {
                    btn_delete.style.display = "block";
                    chooseElement.style.display = "none";
                    viewSelectedElement.innerHTML = resType;
                }else{
                    btn_delete.style.display = "none";
                    chooseElement.style.display = "block";
                    viewSelectedElement.innerHTML = "";
                }
            }
        };
        request.send();
    }

}

function reloadAvatar(){
    const request = new XMLHttpRequest();
    request.open('GET', 'https://topcook.site/avatar/reloadAvatar.php');
    request.onreadystatechange = function(){
        if(request.readyState === 4 && request.status === 200){
            const resType = request.responseText;
            const div = document.getElementById('ajax');
            div.innerHTML = "";
            div.innerHTML = resType;

        }
    };
    request.send();
}

function addElement(id){
    const selectedType = document.getElementById("selectedTypeAccessories");
    const selectedTypeValue = selectedType.options[selectedType.selectedIndex].value;
    const request = new XMLHttpRequest();
    request.open("GET", "https://topcook.site/avatar/addElement.php?id=" + id + "&type=" + selectedTypeValue);
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            const resType = request.responseText;
        }
    };
    request.send();
    reloadAvatar();
}

function deleteAccessories(){
    let selectedType = document.getElementById("selectedTypeAccessories");
    const selectedTypeValue = selectedType.options[selectedType.selectedIndex].value;
    const request = new XMLHttpRequest();
    request.open("GET", "https://topcook.site/avatar/deleteAccessories.php?type=" + selectedTypeValue);
    request.onreadystatechange = function () {
    };
    request.send();
    reloadAvatar();
}