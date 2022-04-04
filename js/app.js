let parameters = {
  count: false,
  letters: false,
  numbers: false,
  special: false,
};
let strengthBar = document.getElementById("strength-bar");
let msg = document.getElementById("msg");

function darkMode() {
  var element = document.body;
  document.getElementById("sun").style.display = "block";
  document.getElementById("moon").style.display = "none";
  //document.getElementById("logo_admin").style.fill = "white";
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
  //document.getElementById("logo_admin").style.fill = "black";
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
  var passInscription = document.getElementById("password");
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
function strengthChecker() {
  let password = document.getElementById("password").value;

  parameters.letters = /[A-Za-z]+/.test(password) ? true : false;
  parameters.numbers = /[0-9]+/.test(password) ? true : false;
  parameters.special = /[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(password)
    ? true
    : false;
  parameters.count = password.length > 6 ? true : false;

  let barLength = Object.values(parameters).filter((value) => value);

  console.log(Object.values(parameters), barLength);

  strengthBar.innerHTML = "";
  for (let i in barLength) {
    let span = document.createElement("span");
    span.classList.add("strength");
    strengthBar.appendChild(span);
  }

  let spanRef = document.getElementsByClassName("strength");
  for (let i = 0; i < spanRef.length; i++) {
    switch (spanRef.length - 1) {
      case 0:
        spanRef[i].style.background = "#ff3e36";
        msg.style.color = "#DA0900";
        msg.textContent = "Votre mot de passe est très faible";
        break;
      case 1:
        spanRef[i].style.background = "#ff691f";
        msg.style.color = "#DE4A01";
        msg.textContent = "Votre mot de passe est faible";
        break;
      case 2:
        spanRef[i].style.background = "#ffda36";
        msg.style.color = "#E2B800";
        msg.textContent = "Votre mot de passe est bon";
        break;
      case 3:
        spanRef[i].style.background = "#0be881";
        msg.style.color = "#00BB64";
        msg.textContent = "Votre mot de passe est fort";
        break;
    }
  }
  if (password.length == 0) {
    msg.textContent = "";
  }
}
let steps2 = 1;
function addRecipe() {
    let input = document.createElement("input");
    steps2++;
    input.setAttribute("type", "text");
    input.setAttribute("name", "steps[]");
    input.setAttribute("placeholder", "Etape " + steps2);
    input.setAttribute("class", "form-control");
    document.getElementById("new-steps").appendChild(input);
}
function removeRecipe() {
  steps2--;
  // remove last input
  let lastInput = document.getElementById("new-steps").lastChild;
  document.getElementById("new-steps").removeChild(lastInput);
}

function checkInputLength(obj) {
  let maxLength = 50;
  let strLength = obj.value.length;

  if (strLength > maxLength) {
    document.getElementById("charNum").innerHTML =
      '<span style="color: red;">' +
      strLength +
      " sur " +
      maxLength +
      " caractères</span>";
  } else {
    document.getElementById("charNum").innerHTML =
      strLength + " sur " + maxLength + " caractères";
  }
}
function addPers(){
  // recuperer le text du span
  let text = parseInt(document.getElementById("pers").textContent);
  // ajouter 1 à chaque click
  text++;
  // sauvegarder le nouveau nombre dans le span
  let text2 = document.getElementById("pers").textContent = text;
}
function removePers(){
  // recuperer le text du span
  let text = parseInt(document.getElementById("pers").textContent);
  if(text > 1) {
    // ajouter 1 à chaque click
    text--;
    // sauvegarder le nouveau nombre dans le span
    let text2 = document.getElementById("pers").textContent = text;
  }
}
