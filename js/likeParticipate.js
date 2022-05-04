
function likeParticipate(id){
    const request = new XMLHttpRequest();
    request.open('POST', 'https://topcook.site/contest/likeParticipate.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            document.getElementById(id).innerHTML = request.responseText;
            if(request.responseText === 'error'){
                document.getElementById("error_voted").innerHTML = "Vous avez déjà voté";
            }
        }
    };
    request.send(`id=${id}`);
}