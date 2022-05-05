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
$mail->Subject = $subject;
$mail->Message = $mailMsg;
$mail->msgHTML($msgHTML);
$mail->CharSet = "UTF-8";
if (!$mail->send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  header(
    "location: $destination?message=Un mail viens de vous etre envoyé !&type=success"
  );
  exit();
}
