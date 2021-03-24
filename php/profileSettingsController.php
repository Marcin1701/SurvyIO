<?php
require('classes\RegisteredUser.php');
require('classes\Database.php');
session_start();
// if zmiana hasla
// na koniec wyloguj
if ($_POST['newPassword'] != "" && $_POST['newPassword2'] != ""){
    $db = new Database();
    $db->connectToDatabase();
    $db->updateUserPassword($_SESSION['CurrentUser']->getUserId(), $_POST['newPassword']);
    header("Location: logoutController.php");
    exit();
}

if ($_POST['newMail'] != ""){
    $db = new Database();
    $db->connectToDatabase();
    $db->updateUserEmail($_SESSION['CurrentUser']->getUserId(), $_POST['newMail']);
    header("Location: logoutController.php");
    exit();
}

$db = new Database();
$db->connectToDatabase();
$db->deleteUser($_SESSION['CurrentUser']->getUserId());
header("Location: logoutController.php");
exit();

// if zmiana maila
// na koniec wyloguj
// if usuwanie konta

?>