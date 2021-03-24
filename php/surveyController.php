<?php

require('classes\Database.php');
require('classes\RegisteredUser.php');

session_start();
$db = new Database();
$db->connectToDatabase();
$db->addSurveyToDatabase(
    $_SESSION['CurrentSurvey']->getSurveyName(), $_SESSION['CurrentSurvey']->getStartDate(), $_SESSION['CurrentSurvey']->getEndDate(), $_SESSION['CurrentSurvey']->getVisibility(),
    $_SESSION['CurrentSurvey']->getCreatorId(),
    $_SESSION['CurrentSurvey']->getCategoryId()
);
foreach($_SESSION['SurveyQuestions'] as $question){
    $dbQuestion = new Database();
    $dbQuestion->connectToDatabase();
    if ($question->getQuestionTypeId() == 1 || $question->getQuestionTypeId() == 2){
        $typeId = $question->getQuestionTypeId();
        $surveyId = $_SESSION['CurrentSurvey']->getSurveyId();
        $surveyId = $surveyId + 1;
        $dbQuestion->addNewQuestion(
            $question->getQuestionText(),
            $question->getQuestionTypeId(),
            $surveyId,
            0,
            0,
            true,
            $question->getMultipleChoiceString());
    }
    else if($question->getQuestionTypeId() == 3){
        $surveyId = $_SESSION['CurrentSurvey']->getSurveyId();
        $surveyId = $surveyId + 1;
        $dbQuestion->addNewQuestion(
            $question->getQuestionText(),
            $question->getQuestionTypeId(),
            $surveyId,
            0,
            0,
            false,
            0);
    }
    else if($question->getQuestionTypeId() == 4){
        $surveyId = $_SESSION['CurrentSurvey']->getSurveyId();
        $surveyId = $surveyId + 1;
        $dbQuestion->addNewQuestion(
            $question->getQuestionText(),
            $question->getQuestionTypeId(),
            $surveyId,
            $question->getMin(),
            $question->getMax(),
            false,
            0);
    }
}
if (isset($_SESSION['CurrentSurvey'])) unset($_SESSION['CurrentSurvey']);
if (isset($_SESSION['ChosenSurveys'])) unset($_SESSION['ChosenSurveys']);
if (isset($_SESSSION['QuestionIndex'])) unset($_SESSION['QuestionIndex']);
if (isset($_SESSION['SurveyQuestions'])) unset($_SESSION['SurveyQuestions']);
header("Location: ../index.php");

exit();
?>