function countLikeParticipate(id) {
  const request = new XMLHttpRequest();
  request.open('GET', 'countLike.php?id=' + id);
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200)
      document.getElementById('result_like').innerHTML = request.responseText;
  };
  request.send();
}

function like(id) {
  const request = new XMLHttpRequest();
  request.open('POST', 'like.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
      document.getElementById('like').innerHTML = request.responseText;
      countLikeParticipate(id, 1);
    }
  };

  request.send('id=' + id);
}

function likeContest(id) {
  console.log(id);
  const request = new XMLHttpRequest();
  request.open('POST', 'https://topcook.site/contest/likeParticipate.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.onreadystatechange = function () {
    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
      let res = request.responseText;
      res = res.split(',');
      if (res[1] === 'liked') {
        document.getElementById(res[0]).classList.add(res[1]);
        console.log(res[3]);
      } else {
        document.getElementById(res[0]).classList.remove(res[1]);
      }
    }
  };
  request.send(`id=${id}`);
  window.location.reload();
}

function errorLike() {
  document.getElementById('error_like').innerHTML =
    '<p class="pe-3 fs-4 alert alert-danger">Vous devez être connecté pour aimer une recette</p>';
}
