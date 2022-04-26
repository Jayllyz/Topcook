function changeColor(name){
    const color = document.getElementById(name);
    const typeIndex = color.selectedIndex;
    const typeOption = color.options[typeIndex];
    const request = new XMLHttpRequest();
    request.open('GET', 'https://topcook.site/avatar/addColor.php?nameCol=' + name + '&color=' + typeOption.value);
    request.onreadystatechange = function () {
    };
    request.send();

}
