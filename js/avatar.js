function changeColor(name) {
  const color = document.getElementById(name);
  const typeIndex = color.selectedIndex;
  const typeOption = color.options[typeIndex];
  const request = new XMLHttpRequest();
  request.open(
    "GET",
    "https://topcook.site/avatar/addColor.php?nameCol=" +
      name +
      "&color=" +
      typeOption.value
  );
  request.onreadystatechange = function () {};
  request.send();
}

function activateAvatar() {
  const request = new XMLHttpRequest();
  request.open("GET", "https://topcook.site/avatar/activateAvatar.php");
  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      location.reload();
    }
  };
  request.send();

}