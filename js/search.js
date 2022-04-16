const searchbar = document.getElementById("searchbar");
const div = document.getElementById("result");

searchbar.addEventListener("keyup", function () {
  div.innerHTML = "";
  let search = searchbar.value;
  if (search !== "") {
    const request = new XMLHttpRequest();
    request.open(
      "GET",
      "https://topcook.site/includes/search.php?search=" + search
    );
    request.onreadystatechange = function () {
      if (request.readyState === 4) {
        const res = request.responseText;
        if (res !== "" && res !== div.innerHTML) {
          div.innerHTML = res;
        } else {
          const div = document.getElementById("result");
          div.innerHTML =
            "<p class='text-center fs-3' style='z-index: 100'>Aucun résultat</p>";
        }
      }
    };
    request.send();
  }
});
