function insert() {
<<<<<<< Updated upstream
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "https://topcook.site/test/insertAjax/insert.php", true);
  request.setRequestHeader("Content-Type", "text/plain");
  const msg = document.getElementById("message").value;
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      console.log("test");
    }
  };

  xhttp.send("msg" + msg);
}
=======
  const request = new XMLHttpRequest();
  request.open('POST', 'https://topcook.site/test/insertAjax/insert.php', true
  );
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
    }
  };

  request.send('msg=' + document.getElementById('message').value);
}
>>>>>>> Stashed changes
