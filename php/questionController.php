<?php
    require('classes\Database.php');
    require('classes\RegisteredUser.php');

    session_start();
    if (isset($_POST['endSurveyCreation']) && !isset($_POST['questionType'])){
        header('Location: surveyController.php');
        exit();
    }
    if (isset($_POST['leaveSurveyCreator'])){
        header('Location: ../index.php');
        exit();
    }
    if (isset($_POST['questionType']) && $_POST['questionType'] == "R1"){
        $_SESSION['NumberOfAnswersToBeGenerated'] = $_POST['numberOfAnswersMultiple'];
    }
    else{
        if (isset($_POST['questionType']) && $_POST['questionType'] == "R2"){
            $_SESSION['NumberOfAnswersToBeGenerated'] = $_POST['numberOfAnswersSingle'];
        }
        else{
            header("Location: ../questionView.php");
        }
    }
    // Wpisz pytanie
    $check = $_POST['qText'];
    if ($check == ''){
        $_SESSION['eQuestionText'] = "Wpisz swoje pytanie!";
        header('Location: ../questionView.php');
        exit();
    }
    // Wybierz typ pytania
    if (!isset($_POST['questionType'])){
        $_SESSION['eQuestionType'] = "Wybierz rodzaj pytania!";
        header('Location: ../questionView.php');
        exit();
    }
    if (!isset($_SESSION['QuestionIndex'])){
        $_SESSION['QuestionIndex'] = 0;
    }
    
    if (!isset($_SESSION['SurveyQuestions'])){
        $_SESSION['SurveyQuestions'] = array();
    }
    $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']] = new Question();
    if (isset($_SESSION['concatenatedStringMultipleChoices'])){
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setMultipleChoiceString($_SESSION['concatenatedStringMultipleChoices']);
        unset($_SESSION['concatenatedStringMultipleChoices']);
    }
    if (isset($_POST['rangeLow']) && isset($_POST['rangeHigh'])){
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setMax($_POST['rangeHigh']);
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setMin($_POST['rangeLow']);
    }else{
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setMax(0);
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setMin(0);
    }

    $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setQuestionText($_POST['qText']);
    $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setSurveyId($_SESSION['CurrentSurvey']->getSurveyId());
    if ($_POST['questionType'] == "R1"){
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setQuestionTypeId(1);
        header('Location: ../generateOptionsView.php');
    }
    else if ($_POST['questionType'] == "R2"){
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setQuestionTypeId(2);
        header('Location: ../generateOptionsView.php');
    }
    else if ($_POST['questionType'] == "R3"){
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setQuestionTypeId(3);
        if (isset($_POST['endSurveyCreation'])){
            header('Location: surveyController.php');
            exit();
        }
        else{
            $_SESSION['QuestionIndex'] = $_SESSION['QuestionIndex'] + 1;
            header('Location: ../questionView.php');
        }
        
    }
    else if ($_POST['questionType'] == "R4"){
        $_SESSION['SurveyQuestions'][$_SESSION['QuestionIndex']]->setQuestionTypeId(4);
        if (isset($_POST['endSurveyCreation'])){
            if (isset($_POST['endSurveyCreation'])){
                header('Location: surveyController.php');
                exit();
        }
        else{
            $_SESSION['QuestionIndex'] = $_SESSION['QuestionIndex'] + 1;
            header('Location: ../questionView.php');
        }
    }
}
?>