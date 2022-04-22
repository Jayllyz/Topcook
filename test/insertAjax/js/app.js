function insert() {
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
