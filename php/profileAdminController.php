<?php
require('classes\Database.php');
session_start();

$db = new Database();
$db->connectToDatabase();

if ($_POST['idUser'] != ""){
    // usun usera
    $db->deleteUser($_POST['idUser']);
    if (!isset($_SESSION['userDeleted'])){
        $_SESSION['userDeleted'] = "Użytkownik usunięty";
    }
    header('Location: ../profileAdminView.php');
    exit();
}
if($_POST['idSurvey'] != ""){
    // ukryj ankiete
    $db->hideSurvey($_POST['idSurvey']);
    if (!isset($_SESSION['surveyHidden'])){
        $_SESSION['surveyHidden'] = "Ankieta ukryta";
    }
    header('Location: ../profileAdminView.php');
    exit();
}
?>