let parameters = {
  count: false,
  letters: false,
  numbers: false,
  special: false,
};
let strengthBar = document.getElementById('strength-bar');
let msg = document.getElementById('msg');

function viewPassword() {
  var passConnexion = document.getElementById('password');

  if (passConnexion.type === 'password') {
    passConnexion.type = 'text';
  } else {
    passConnexion.type = 'password';
  }
}

function viewPasswordInscription() {
  var passInscription = document.getElementById('password');
  if (passInscription.type === 'password') {
    passInscription.type = 'text';
  } else {
    passInscription.type = 'password';
  }
}

function viewConfPasswordInscription() {
  var confPassInscription = document.getElementById('conf_Password_inscription');
  if (confPassInscription.type === 'password') {
    confPassInscription.type = 'text';
  } else {
    confPassInscription.type = 'password';
  }
}
function strengthChecker() {
  let password = document.getElementById('password').value;

  parameters.letters = /[A-Za-z]+/.test(password) ? true : false;
  parameters.numbers = /[0-9]+/.test(password) ? true : false;
  parameters.special = /[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(password) ? true : false;
  parameters.count = password.length > 6 ? true : false;

  let barLength = Object.values(parameters).filter((value) => value);

  strengthBar.innerHTML = '';
  for (let i in barLength) {
    let span = document.createElement('span');
    span.classList.add('strength');
    strengthBar.appendChild(span);
  }

  let spanRef = document.getElementsByClassName('strength');
  for (let i = 0; i < spanRef.length; i++) {
    switch (spanRef.length - 1) {
      case 0:
        spanRef[i].style.background = '#ff3e36';
        msg.style.color = '#DA0900';
        msg.textContent = 'Votre mot de passe est très faible';
        break;
      case 1:
        spanRef[i].style.background = '#ff691f';
        msg.style.color = '#DE4A01';
        msg.textContent = 'Votre mot de passe est faible';
        break;
      case 2:
        spanRef[i].style.background = '#ffda36';
        msg.style.color = '#E2B800';
        msg.textContent = 'Votre mot de passe est bon';
        break;
      case 3:
        spanRef[i].style.background = '#0be881';
        msg.style.color = '#00BB64';
        msg.textContent = 'Votre mot de passe est fort';
        break;
    }
  }
  if (password.length == 0) {
    msg.textContent = '';
  }
}
let steps2 = 1;
let ingredient = 1;
let quantity = 1;
function addRecipe() {
  let input = document.createElement('input');
  steps2++;
  input.setAttribute('type', 'text');
  input.setAttribute('name', 'steps[]');
  input.setAttribute('placeholder', 'Etape ' + steps2);
  input.setAttribute('class', 'form-control');
  document.getElementById('new-steps').appendChild(input);
}
function removeRecipe() {
  if (steps2 > 1) {
    steps2--;
    // remove last input
    let lastInput = document.getElementById('new-steps').lastChild;
    document.getElementById('new-steps').removeChild(lastInput);
  }
}
function addIngredients() {
  let inputIngredients = document.createElement('input');
  let inputQuantity = document.createElement('input');
  // Create select element and populate it with options
  let select = document.createElement('select');
  select.setAttribute('name', 'unit[]');
  select.setAttribute('class', 'form-control unit');
  let option1 = document.createElement('option');
  option1.text = 'g';
  option1.value = 'g';
  let option2 = document.createElement('option');
  option2.text = 'cl';
  option2.value = 'cl';

  select.add(option1);
  select.add(option2);

  ingredient++;
  quantity++;

  inputIngredients.setAttribute('type', 'text');
  inputQuantity.setAttribute('type', 'number');

  inputIngredients.setAttribute('name', 'ingredients[]');
  inputQuantity.setAttribute('name', 'quantity[]');

  inputIngredients.setAttribute('placeholder', 'Ingrédient ' + ingredient);
  inputQuantity.setAttribute('placeholder', 'Quantitée');

  inputIngredients.setAttribute('class', 'form-control ingredient');
  inputQuantity.setAttribute('class', 'form-control quantity');
  inputIngredients.setAttribute('required', 'required');
  inputQuantity.setAttribute('required', 'required');

  document.getElementById('new-ingredients').appendChild(inputIngredients);
  document.getElementById('new-ingredients').appendChild(inputQuantity);
  document.getElementById('new-ingredients').appendChild(select);
}
function removeIngredients() {
  if (ingredient > 1) {
    ingredient--;
    // remove last input
    let lastInputIngredients = document.getElementById('new-ingredients').lastChild;

    document.getElementById('new-ingredients').removeChild(lastInputIngredients);
  }
  if (quantity > 1) {
    quantity--;
    let lastInputQuantity = document.getElementById('new-ingredients').lastChild;
    document.getElementById('new-ingredients').removeChild(lastInputQuantity);
    let lastInputSelected = document.getElementById('new-ingredients').lastChild;
    document.getElementById('new-ingredients').removeChild(lastInputSelected);
  }
}

function checkInputLength(obj, maxLength) {
  let strLength = obj.value.length;

  if (strLength > maxLength) {
    document.getElementById('charNum').innerHTML =
      '<span style="color: red;">' + strLength + ' sur ' + maxLength + ' caractères</span>';
  } else {
    document.getElementById('charNum').innerHTML = strLength + ' sur ' + maxLength + ' caractères';
  }
}

let compteur = 0;
let quantityForOnePeople = [];
let quantitys = document.querySelectorAll('.quantity');
let text = parseInt(document.getElementById('pers').textContent);
let nameIngredient = document.querySelectorAll('.name_ingredient');

function addPers() {
  for (let i = 0; i < quantitys.length; i++) {
    quantityForOnePeople.push(parseInt(quantitys[i].innerHTML) / text);
    let quantityNumber = parseInt(quantitys[i].innerHTML);
    quantityNumber += quantityForOnePeople[i];
    quantitys[i].textContent = parseInt(quantityNumber);
  }
  text++;

  let text2 = (document.getElementById('pers').innerHTML = text);
}

function removePers() {
  compteur--;

  if (text > 1) {
    for (let i = 0; i < quantitys.length; i++) {
      quantityForOnePeople.push(parseInt(quantitys[i].innerHTML) / text);
      let quantityNumber = parseInt(quantitys[i].innerHTML);
      if (quantityNumber > 0) {
        quantityNumber -= quantityForOnePeople[i];
        quantitys[i].textContent = parseInt(quantityNumber);
      }
    }
    text--;
    // sauvegarder le nouveau nombre dans le span
    let text2 = (document.getElementById('pers').innerHTML = text);
  }
}

function checkConfirm(text) {
  if (confirm(text) === true) {
    return true;
  } else {
    return false;
  }
}
