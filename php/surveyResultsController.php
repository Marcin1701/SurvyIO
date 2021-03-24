<?php

require('classes\Database.php');
require('classes\RegisteredUser.php');
session_start();

if (!isset($_SESSION['CurrentUser']))
    header('Location: ../loginView.php');

$_SESSION['ResultSurveys'] = array();
$db = new Database();
$db->connectToDatabase();
$_SESSION['ResultSurveys'] = $db->getSurveysByUserId($_SESSION['CurrentUser']->getUserId());
header('Location: ../surveyResultsView.php');
exit();


?>