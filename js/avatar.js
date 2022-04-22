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
    let body = document.getElementById("test").value;
    let eyes = document.getElementById("test2").value;
    let hat = document.getElementById("test3").value;
    let sweet = document.getElementById("test4").value;
    const request = new XMLHttpRequest();
    request.open('POST', 'https://topcook.site/verifications/addAvatar.php', true
    );
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        const res = request.responseText;
        if (request.readyState === 4 && request.status === 200) {
            document.getElementById("error").innerHTML = res;
        }
    };

    request.send("body=" + body + "&eyes=" + eyes + "&hat=" + hat + "&sweet=" + sweet );

}
