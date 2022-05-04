function validateForm(nameForm) {
  let i;
  let x;
  let y = document.forms[nameForm].elements;
  console.log(y);
  for (i = 0; i < y.length; i++) {
    x = document.forms[nameForm].elements[i].value;
    console.log(x);
    if (x === "") {
      alert("Veuillez remplir tous les champs");
      return false;
    }
  }
}
