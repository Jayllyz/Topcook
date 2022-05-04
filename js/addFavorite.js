

function addFavorite(id){
    const result_favorite = document.getElementById("result_favorite");
    const favorite = document.getElementById("btn-favorite");
    const request = new XMLHttpRequest();
    request.open('POST', 'https://topcook.site/recipes/addFavorite.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            favorite.innerHTML = request.responseText;
        }
    };
    request.send(`id=${id}`);
}