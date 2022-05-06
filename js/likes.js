function countLikeParticipate(id, type) {
  const request = new XMLHttpRequest();
  if (type === 0) {
    request.open(
      "GET",
      "https://topcook.site/contest/countLikeParticipate.php?id=" + id
    );
    request.onreadystatechange = function () {
      if (
        request.readyState === XMLHttpRequest.DONE &&
        request.status === 200
      ) {
        const result_like = document.querySelectorAll(".result_like");
        for (let i = 0; i < result_like.length; i++) {
          result_like[i].innerHTML = request.responseText;
        }
      }
    };
  } else {
    request.open("GET", "countLike.php?id=" + id);
    request.onreadystatechange = function () {
      if (
        request.readyState === XMLHttpRequest.DONE &&
        request.status === 200
      ) {
        document.getElementById("result_like").innerHTML = request.responseText;
      }
    };
  }

  request.send();
}

function like(id) {
  const request = new XMLHttpRequest();
  request.open("POST", "like.php");
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
      document.getElementById("like").innerHTML = request.responseText;
      countLikeParticipate(id, 1);
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
      let res = request.responseText;
      res = res.split(",");
      if (res[1] === "liked") {
        document.getElementById(res[0]).classList.add(res[1]);
      } else {
        document.getElementById(res[0]).removeAttribute("class");
      }
      countLikeParticipate(id, 0);
    }
  };
  request.send(`id=${id}`);
}

function errorLike() {
  document.getElementById("error_like").innerHTML =
    '<p class="pe-3 fs-4 alert alert-danger">Vous devez être connecté pour aimer une recette</p>';
}
