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
  <body>
    <h1>Puzzle</h1>
    <div class="puzzle col-md-5" style="margin: 0 auto;">
      <img src="../../images/captcha/minion/image1.jpg" id="image1" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image2.jpg" id="image2" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image3.jpg" id="image3" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image4.jpg" id="image4" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image5.jpg" id="image5" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image6.jpg" id="image6" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image7.jpg" id="image7" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image8.jpg" id="image8" onclick="changeImage(this.src, this.id)">
      <img src="../../images/captcha/minion/image9.jpg" id="image9" onclick="changeImage(this.src, this.id)">
    </div>
    <script src="js/app.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
