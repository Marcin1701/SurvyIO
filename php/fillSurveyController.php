<?php
require('classes\Database.php');
session_start();
if (!isset($_SESSION['answeredQuestions'])){
    $_SESSION['answeredQuestions'] = array();
}
$db = new Database();
$db->connectToDatabase();
$postIndex = 0;
foreach($_SESSION['SurveyQuestions'] as $question){
    if($question->getQuestionTypeId() == "1"){
        $toBeSend = "";
        $tempIndex = 0;
        for($i = $tempIndex; $i < 1000; $i++){
            if(isset($_POST[$postIndex.'-c'.$i])){
                // dodaj do bazy id_pytania i tresc odpowiedzi
                $toBeSend = $toBeSend.$_POST[$postIndex.'-c'.$i];
            }
        }
        $db->addMultipleAnswerQuestion($question->getQuestionId(), $toBeSend);
        $postIndex = $postIndex + 1;
    }
    else if($question->getQuestionTypeId() == "2"){
        // dodaj do bazy id_pytania i tresc odpowiedzi
        $db->addSingleAnswerQuestion($question->getQuestionId(), $_POST[$postIndex]);
        $postIndex = $postIndex + 1;
    }
    else if($question->getQuestionTypeId() == "3"){
        // dodaj do bazy id_pytania i tresc odpowiedzi
        $db->addTextAnswerQuestion($question->getQuestionId(), $_POST[$postIndex]);
        $postIndex = $postIndex + 1;
    }
    else if($question->getQuestionTypeId() == "4"){
        // dodaj do bazy id_pytania i tresc odpowiedzi
        $db->addRangeAnswerQuestion($question->getQuestionId(), $_POST[$postIndex]);
        $postIndex = $postIndex + 1;
    }
}
header('Location: ../index.php');
?>