function changeTypeAccessories() {
  const chooseElement = document.getElementById("chooseElement");
  const viewSelectedElement = document.getElementById("viewSelectedElement");
  let selectedType = document.getElementById("selectedTypeAccessories");
  let selectedTypeValue =
    selectedType.options[selectedType.selectedIndex].value;
  const btn_delete = document.getElementById("btn_delete");
  const eyes = document.getElementById("eyes-presentation");
  const hair = document.getElementById("hair-presentation");
  const mouth = document.getElementById("mouth-presentation");
  const beard = document.getElementById("beard-presentation");
  const hat = document.getElementById("hat-presentation");
  const sweat = document.getElementById("sweat-presentation");

  if (selectedTypeValue) {
    const request = new XMLHttpRequest();
    request.open(
      "GET",
      "https://topcook.site/avatar/selectedTypeAccessories.php?type=" +
        selectedTypeValue
    );
    request.onreadystatechange = function () {
      if (request.readyState === 4) {
        const resType = request.responseText;
        if (selectedTypeValue !== "Choisir un type d'accessoire") {
          btn_delete.style.display = "block";
          chooseElement.style.display = "none";
          viewSelectedElement.innerHTML = resType;
        } else {
          btn_delete.style.display = "none";
          chooseElement.style.display = "block";
          viewSelectedElement.innerHTML = "";
        }
      }
    };
    request.send();
  }
}

function reloadAvatar() {
  const request = new XMLHttpRequest();
  request.open("GET", "https://topcook.site/avatar/reloadAvatar.php");
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE) {
      const resType = request.responseText;
      const div = document.getElementById("ajax");
      div.innerHTML = "";
      div.innerHTML = resType;

      const request2 = new XMLHttpRequest();
      request2.open("GET", "https://topcook.site/avatar/getColor.php");
      request2.onreadystatechange = function () {
        if (request2.readyState === XMLHttpRequest.DONE) {
          const res = request2.responseText;
          console.log(res);
          let array = res.split(",");

          let hair = document.getElementById("hair-path");
          if (hair !== null) {
            hair.setAttribute("fill", "#" + array[0]);
            let hairInput = document.getElementById("colorHair");
            if(hirInput !== null){
              hairInput.value = "#" + array[0];
            }
            
          }

          let hat = document.getElementById("hat-path");
          if (hat !== null) {
            hat.setAttribute("fill", "#" + array[1]);
            let hatInput = document.getElementById("colorHat");
            if(hatInput !== null){
              hatInput.value = "#" + array[1];
            }

          }

          let sweet = document.getElementById("sweet-path");
          if (sweet !== null) {
            sweet.setAttribute("fill", "#" + array[2]);
            let sweetInput = document.getElementById("colorSweat");
            if(sweetInput !== null){
              sweetInput.value = "#" + array[2];
            }

          }

          let eyes = document.getElementById("eyes-path");

          if (eyes !== null) {
            eyes.setAttribute("fill", "#" + array[3]);
            let eyesInput = document.getElementById("colorEyes");
            if(eyesInput !== null){
              eyesInput.value = "#" + array[3];
            }
          }

          let beard = document.getElementById("beard-path");
          if (beard !== null) {
            beard.setAttribute("fill", "#" + array[4]);
            let beardInput = document.getElementById("colorBeard");
            if(beardInput !== null){
              beardInput.value = "#" + array[4];
            }

          }
          let body = document.getElementById("body");

          if (body !== null) {
            body.setAttribute("fill", "#" + array[5]);
            let bodyInput = document.getElementById("colorBody");
            if(bodyInput !== null){
              bodyInput.value = "#" + array[5];
            }

          }
        }
      };
      request2.send();
    }
  };
  request.send();
}

function addElement(id) {
  const selectedType = document.getElementById("selectedTypeAccessories");
  const selectedTypeValue =
    selectedType.options[selectedType.selectedIndex].value;
  const request = new XMLHttpRequest();
  request.open(
    "GET",
    "https://topcook.site/avatar/addElement.php?id=" +
      id +
      "&type=" +
      selectedTypeValue
  );
  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      const resType = request.responseText;
    }
  };
  request.send();
  reloadAvatar();
}

function deleteAccessories() {
  let selectedType = document.getElementById("selectedTypeAccessories");
  const selectedTypeValue =
    selectedType.options[selectedType.selectedIndex].value;
  const request = new XMLHttpRequest();
  request.open(
    "GET",
    "https://topcook.site/avatar/deleteAccessories.php?type=" +
      selectedTypeValue
  );
  request.onreadystatechange = function () {};
  request.send();
  reloadAvatar();
}
