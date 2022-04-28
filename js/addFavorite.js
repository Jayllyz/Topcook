function addFavorite(id){
    const result_favorite = document.getElementById("result_favorite");
    const request = new XMLHttpRequest();
    request.open('GET', 'https://topcook.site/recipes/addFavorite.php?id='+id);
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            result_favorite.innerHTML = request.responseText;
        }
    };
    request.send();

}
function removeFavorite(id){
    const result_favorite = document.getElementById("result_favorite");
    const request = new XMLHttpRequest();
    request.open('GET', 'https://topcook.site/recipes/removeFavorite.php?id='+id);
    request.onreadystatechange = function() {
        if (request.readyState === 4) {
            result_favorite.innerHTML = request.responseText;
        }
    };
    request.send();
}