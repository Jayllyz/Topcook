<?php
session_start();
require('../includes/fpdf/fpdf.php');
include "../includes/db.php";
$query = $db->query(
    "SELECT id, pseudo, email, date_birth, creation FROM USER WHERE id = " .
    $_SESSION["id"]
);
$user = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($user as $infoUser){
    $id = $infoUser["id"];
    $pseudo = $infoUser["pseudo"];
    $email = $infoUser["email"];
    $date_birth = $infoUser["date_birth"];
    // Date format
    $date_birth = date("d/m/Y", strtotime($date_birth));
    $creation = $infoUser["creation"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(80);
$pdf->Image('https://topcook.site/images/logo_topcook.png',10,6,30);
$pdf->Cell(40,30,'Vos informations');
$pdf->Ln();
$pdf->Cell(40,10,'Votre pseudo : '.$pseudo);
$pdf->Ln();
$pdf->Cell(40,10,'Votre email : '.$email);
$pdf->Ln();
$pdf->Cell(40,10,'Votre date de naissance : '.$date_birth);
$pdf->Ln();
$pdf->Cell(40,10,'Votre date d\'inscription : '.$creation);
// Download the file in the desktop
$pdf->Output('' . $pseudo . '_topcook.pdf','D');

}

?>
