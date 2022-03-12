<?php

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = "topcook2022@gmail.com";
$mail->Password = "TopCook.2022#ESGI";
$mail->setFrom("dsebagpro@gmail.com", "No-Reply");
$mail->addAddress($email);
$mail->Subject = "Confirm your registration";
$mail->Message = "Valid your registration !";
$mail->msgHTML("<h1>SOMBIE LE BOSS</h1>");
if (!$mail->send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "
    <div class='mx-auto text-center'>
    <div class='alert alert-success' role='alert'>
      <h4 class='alert-heading display-5'>Well done !</h4>
      <p class='display-5'>Look at your mailbox you must
      have received a confirmation email. <br>Check your spam if we are not in your inbox.</p>
      <hr>
      <p class='mb-0 fs-3'>Click the link in the email to start enjoying our site fully.</p>
      <p class='mb-0 fs-3'>You can close this page. If you did not receive the email, click <a href='https://dna-esgi.fr/includes/email_resend.php?email=" .
    $email .
    "&token=" .
    $token .
    "&id_account=" .
    $id_account .
    "'>here</a> to resend it.
      </div>
      </div>
    </div>
    </div>
    ";
}

?>
