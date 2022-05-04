function validateForm(nameForm) {
  let i;
  let x;
  let y = document.forms[nameForm].elements;
  console.log(y);
  for (i = 0; i < y.length; i++) {
    x = document.forms[nameForm].elements[i];
    console.log(x.nodeName);
    if (x.value === "" && x.nodeName === "INPUT") {
      console.log("empty");
      console.log(x.nodeName);
      alert("Veuillez remplir tous les champs");
      return false;
    }
  }
}
