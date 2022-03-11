function darkMode() {
  var element = document.body;
  document.getElementById("sun").style.display = "block";
  document.getElementById("moon").style.display = "none";
  element.style.background = "#011A27"; // Test d'exemple pour dark-mode (à modifier selon nos couleurs)
  document.getElementById("navbar").style.background = "#063C58";
  document.getElementById("svg_sun").style.color = "white";
  document.getElementById("navbar-toggler").style.background = "white";
  document.getElementById("form").style.color = "white";
}
function lightMode() {
  var element_sun = document.body;
  document.getElementById("moon").style.display = "block";
  document.getElementById("sun").style.display = "none";
  element_sun.style.background = "white"; // Test d'exemple pour dark-mode (à modifier selon nos couleurs)
  element_sun.style.color = "black";
  document.getElementById("navbar").style.background = "#f8f9fa";
}
