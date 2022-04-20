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


