function countLike(){
    const request = new XMLHttpRequest();
    request.open('GET', 'countLike.php');
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            document.getElementById("result_like").innerHTML = request.responseText;
        }
    };
    request.send();
}

function unlike(id){
    const request = new XMLHttpRequest();
    request.open('POST', 'unlike.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            const img = document.createElement('img');
            img.src = '../../images/like.svg';
            img.id = 'like';
            img.alt = 'liked';
            img.width = 30;
            img.height = 30;
            img.setAttribute('onclick', 'like(' + id + ')');
            document.getElementById("like").innerHTML = img.outerHTML;
        }
    };
    request.send('id=' + id);
    countLike();
}

function like(id){
    const request = new XMLHttpRequest();
    request.open('POST', 'like.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            const img = document.createElement('img');
            img.src = '../../images/like.svg';
            img.id = 'like';
            img.alt = 'liked';
            img.width = 30;
            img.height = 30;
            img.setAttribute('onclick', 'unlike(' + id + ')');
            document.getElementById("like").innerHTML = img.outerHTML;
        }
    };
    request.send('id=' + id);
    countLike();
}
