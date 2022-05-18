function addFavorite(id) {
  const favorite = document.getElementById('favorite');
  const request = new XMLHttpRequest();
  request.open('POST', 'https://topcook.site/recipes/addFavorite.php');
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.onreadystatechange = function () {
    if (request.readyState === 4) {
      console.log(request.responseText);
      favorite.innerHTML = request.responseText;
    }
  };
  request.send(`id=${id}`);
}
