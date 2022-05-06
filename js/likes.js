function countLike(id) {
  const request = new XMLHttpRequest();
  request.open("GET", "countLike.php?id=" + id);
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
      document.getElementById("result_like").innerHTML = request.responseText;
    }
  };
  request.send();
}

function like(id) {
  const request = new XMLHttpRequest();
  request.open("POST", "like.php");
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
      document.getElementById("like").innerHTML = request.responseText;
      countLike(id);
    }
  };
  request.send("id=" + id);
}

function likeContest(id) {
  const request = new XMLHttpRequest();
  request.open("POST", "https://topcook.site/contest/likeParticipate.php");
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
      document.getElementById("like").innerHTML = request.responseText;
      countLike(id);
    }
  };
  request.send(`id=${id}`);
}

function errorLike() {
  document.getElementById("error_like").innerHTML =
    '<p class="pe-3 fs-4 alert alert-danger">Vous devez être connecté pour aimer une recette</p>';
}
