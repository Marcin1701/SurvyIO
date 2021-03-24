<?php

require('classes\Database.php');
require('classes\RegisteredUser.php');
session_start();

if (isset($_SESSION['NoSurveys'])){
    unset($_SESSION['NoSurveys']);
}

if (!isset($_SESSION['CurrentUser'])){
    header('Location: ../loginView.php');
    exit();
}

$db = new Database();
$db->connectToDatabase();
$_SESSION['UserSurveys'] = $db->getSurveysByUserId($_SESSION['CurrentUser']->getUserId());
if($_SESSION['UserSurveys'] == 0){
    $_SESSION['NoSurveys'] = "Brak stworzonych ankiet!";
    header('Location: ../profileCreatedSurveysView.php');
    exit();
}
$_SESSION['SurveyUlrs'] = array();
for ($i = 0; $i < sizeof($_SESSION['UserSurveys']); $i++){
    $_SESSION['SurveyUrls'][$i] = "localhost/Serwis%20Ankietowy/php/indexController.php/".$_SESSION['UserSurveys'][$i]->getSurveyId();
}
header('Location: ../profileCreatedSurveysView.php');
exit();

?>