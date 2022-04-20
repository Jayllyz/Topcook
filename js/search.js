const searchbar = document.getElementById("searchbar");
const div = document.createElement("div");

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
      if (request.readyState === 4 && request.status === 200) {
        const res = request.responseText;
        div.style.display = "block";
        if (res !== "") {
          const containerSearch = document.getElementById("container-search");
          div.setAttribute("id", "result");
          containerSearch.appendChild(div);
          div.innerHTML = res;

        } else {
          const div = document.getElementById("result");
          div.innerHTML = "<p class='text-center fs-3'>Aucun résultat</p>";


        }
      }
    };
    request.send();
  }else{
    div.style.display = "none";
  }
});



