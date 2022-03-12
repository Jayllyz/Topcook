<?php

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPSecure = "tls";
$mail->SMTPAuth = true;
$mail->Username = "topcook2022@gmail.com";
$mail->Password = "TopCook.2022#ESGI";
$mail->setFrom("topcook2022@gmail.com", "No-Reply");
$mail->addAddress($email);
$mail->Subject = "Confirmation de votre inscription";
$mail->Message = "Validé votre inscription!";
$mail->msgHTML(
  '<img src="http://164.132.229.157/images/topcook_logo.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo">
            <p class="display-2">Bienvenue sur TopCook. Veuillez cliquer sur le lien ci-dessous pour confirmer votre inscription :<br></p>
  <a href="http://164.132.229.157/includes/conf_registration.php?' .
    "token=" .
    $token .
    "&email=" .
    $email .
    '">Confirmation !</a>'
);
if (!$mail->send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "
    <div class='mx-auto text-center'>
    <div class='alert alert-success' role='alert'>
      <h4 class='alert-heading display-5'>Félicitation !</h4>
      <p class='display-5'Regardez votre messagerie, vous devez avoir reçu un courriel de confirmation. Vérifiez votre spam si nous ne sommes pas dans votre boîte de réception.</p>
      <hr>
      <p class='mb-0 fs-3'>Cliquez sur le lien dans l'e-mail pour commencer à profiter pleinement de notre site.</p>
      <p class='mb-0 fs-3'>Vous pouvez fermer cette page. Si vous n'avez pas reçu l'e-mail, cliquez sur <a href='http://164.132.229.157/includes/conf_registration.php?" .
    "token=" .
    $token .
    "&email=" .
    $email .
    "'>here</a> pour le renvoyer.
      </p>
      </div>
      </div>
    </div>
    </div>
    ";
}

?>
