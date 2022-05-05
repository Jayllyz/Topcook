function likeParticipate(id) {
  const request = new XMLHttpRequest();
  request.open("POST", "https://topcook.site/contest/likeParticipate.php");

  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
      document.getElementById(id).innerHTML = request.responseText;
    }
  };
  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  request.send(`id=${id}`);
}
