<?PHP
session_start();
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
include "../includes/db.php";

$select = $db->query("SELECT id FROM CONTEST ORDER BY id DESC LIMIT 1");
$select = $select->fetch(PDO::FETCH_ASSOC);
$selectFinish = $db->query("SELECT finish FROM CONTEST WHERE id = " . $select["id"]);
$selectFinish = $selectFinish->fetch(PDO::FETCH_ASSOC);

if ($selectFinish["finish"] === '0') {
    $update = $db->query("UPDATE CONTEST SET finish = '1' WHERE id = '$select[id]'");
    $selectIdWinner = $db->query("SELECT id_proposal,  votes, count(votes) AS OCC FROM LIKES_CONTEST WHERE id_contest = " .$select['id'] ." GROUP BY votes ORDER BY OCC DESC LIMIT 1");
    $resultIdWinner = $selectIdWinner->fetch(PDO::FETCH_ASSOC);
    $IdWinner = $resultIdWinner["id_proposal"];
    $updateWinner = $db->query("UPDATE USER SET victory = 1 WHERE id = " . $IdWinner);
    var_dump($IdWinner);
}
