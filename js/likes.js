function countLike(id){
    const request = new XMLHttpRequest();
    request.open('GET', 'countLike.php?id='+id);
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            document.getElementById("result_like").innerHTML = request.responseText;
        }
    };
    request.send();
}

function like(id){
    const request = new XMLHttpRequest();
    request.open('POST', 'like.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            
        }
    };
    request.send('id=' + id);
    countLike(id);
}