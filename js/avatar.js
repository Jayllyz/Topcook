function changeCorps() {
    let select = document.getElementById("test");
    console.log(select);
    let selectOptions = select.options[select.selectedIndex].value;
    let corps = document.getElementById("body");

    if (selectOptions) {
        corps.style.fill = selectOptions;
    }
    if (selectOptions === "start") {
        corps.style.fill = "#E9ADA1";
    }
}

function changeEyes() {
    let select = document.getElementById("test2");

    let selectOptions = select.options[select.selectedIndex].value;
    let eyes = document.getElementById("eyes");
    if (selectOptions) {
        eyes.style.fill = selectOptions;
    }
    if (selectOptions === "start") {
        eyes.style.fill = "#00004D";
    }
}
function changeHat() {
    let select = document.getElementById("test3");

    let selectOptions = select.options[select.selectedIndex].value;
    let eyes = document.getElementById("hat");
    if (selectOptions) {
        eyes.style.fill = selectOptions;
    }
    if (selectOptions === "start") {
        eyes.style.fill = "#00004D";
    }
}
function changeSweet() {
    let select = document.getElementById("test4");

    let selectOptions = select.options[select.selectedIndex].value;
    let eyes = document.getElementById("sweet");
    if (selectOptions) {
        eyes.style.fill = selectOptions;
    }
    if (selectOptions === "start") {
        eyes.style.fill = "#00004D";
    }
}
function changeMouth() {
    let select = document.getElementById("test5");

    let selectOptions = select.options[select.selectedIndex].value;
    let eyes = document.getElementById("mouth");
    if (selectOptions) {
        eyes.style.fill = selectOptions;
    }
    if (selectOptions === "start") {
        eyes.style.fill = "#00004D";
    }
}

function changeBeard() {
    let select = document.getElementById("test6");

    let selectOptions = select.options[select.selectedIndex].value;
    let eyes = document.getElementById("beard");
    if (selectOptions) {
        eyes.style.fill = selectOptions;
    }
    if (selectOptions === "start") {
        eyes.style.fill = "#00004D";
    }


}

function addAvatar() {
    let body = document.getElementById("test");
    let eyes = document.getElementById("test2");
    let hat = document.getElementById("test3");
    let sweet = document.getElementById("test4");
    const request = new XMLHttpRequest();
    request.open('POST', 'https://topcook.site/verifications/addAvatar.php', true
    );
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
        }
    };

    request.send("body=" + body.options[body.selectedIndex].value + "&eyes=" + eyes.options[eyes.selectedIndex].value + "&hat=" + hat.options[hat.selectedIndex].value + "&sweet=" + sweet.options[sweet.selectedIndex].value);

}
