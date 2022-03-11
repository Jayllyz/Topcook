function darkMode() {
  var element = document.body;
  element.style.background = "black"; // Test d'exemple pour dark-mode (à modifier selon nos couleurs)
  element.style.color = "white";
  document.getElementById("sun").style.display = "block";
  document.getElementById("moon").style.display = "none";
}
function lightMode() {
  var element_sun = document.body;
  element_sun.style.background = "white"; // Test d'exemple pour dark-mode (à modifier selon nos couleurs)
  element_sun.style.color = "black";
  document.getElementById("moon").style.display = "block";
  document.getElementById("sun").style.display = "none";
}
