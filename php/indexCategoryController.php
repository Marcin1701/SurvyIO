<?php
    // Wyświetl aktywne ankiety na stronie głównej
    require('..\classes\Database.php');
    session_start();
    // Dodaj kategorię
    $ChosenCategory = $_POST['Category'];
    $db = new Database();
    $db->connectToDatabase();
    // Pobierz nazwy ankiet w wybranej kategorii
    $_SESSION['ChosenSurveys'] = $db->getSurveyNamesByCategoryName($ChosenCategory);
    if($_SESSION['ChosenSurveys'] == 0){
        unset($_SESSION['ChosenSurveys']);
    }
    header('Location: ../index.php');
?>