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
function viewPassword() {
  var passConnexion = document.getElementById("password");

  if (passConnexion.type === "password") {
    passConnexion.type = "text";
  } else {
    passConnexion.type = "password";
  }
}

function viewPasswordInscription() {
  var passInscription = document.getElementById("password_inscription");
  if (passInscription.type === "password") {
    passInscription.type = "text";
  } else {
    passInscription.type = "password";
  }
}

function viewConfPasswordInscription() {
  var confPassInscription = document.getElementById(
    "conf_Password_inscription"
  );
  if (confPassInscription.type === "password") {
    confPassInscription.type = "text";
  } else {
    confPassInscription.type = "password";
  }
}
