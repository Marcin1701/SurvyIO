<?php
    require('classes\Question.php');
    session_start();
    // Zmienna z przetworzonym łańcuchem
    $temp = "";
    for ($i = 0; $i < $_SESSION['NumberOfAnswersToBeGenerated']; $i++){
        $temp = $temp.$i.'-'.$_POST[$i].',';
    }
    // Dodaj przetworzony łańcuch do zmiennej sesyjnej
    $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setMultipleChoiceString($temp);
    $_SESSION['QuestionIndex'] = $_SESSION['QuestionIndex'] + 1;
    header('Location: ../questionView.php');
?>