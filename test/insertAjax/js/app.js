function insert(){
    const xhttp = new XMLHttpRequest();
    const msg = document.getElementById("message").value;
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {

        }
    };
    xhttp.open("POST", "insert.php", true);
    xhttp.send("msg="+msg);
}