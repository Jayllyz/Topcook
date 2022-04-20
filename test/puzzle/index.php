<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../../includes/functions.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
  </head>
  <body onload="randomImg()">
    <h1>Puzzle</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Captcha
    </button>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Captcha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="puzzle col-md-5" id="puzzle" style="margin: 0 auto;">
                        <img src="../../images/captcha/minion/1.jpg" id="1" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/2.jpg" id="2" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/3.jpg" id="3" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/4.jpg" id="4" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/5.jpg" id="5" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/6.jpg" id="6" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/7.jpg" id="7" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/8.jpg" id="8" onclick="changeImage(this.src, this.id)">
                        <img src="../../images/captcha/minion/9.jpg" id="9" onclick="changeImage(this.src, this.id)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/app.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
