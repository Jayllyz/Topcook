function insert() {
  const request = new XMLHttpRequest();
  request.open("POST", "https://topcook.site/test/insertAjax/insert.php", true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.onreadystatechange = function () {
    if (request.readyState === 4 && request.status === 200) {
    }
  };

  request.send("msg=" + document.getElementById("message").value);
}
