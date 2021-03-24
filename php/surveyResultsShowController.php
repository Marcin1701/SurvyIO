<?php
require('classes\Database.php');
session_start();

if (isset($_SESSION['OptionsArrayOfArrays'])){ unset($_SESSION['OptionsArrayOfArrays']); }
//if (isset($_SESSION['ResultSurveys'])){ unset($_SESSION['ResultSurveys']); }
if (isset($_SESSION['ResultsSurvey'])){ unset($_SESSION['ResultsSurvey']); }
if (isset($_SESSION['CountResults'])){ unset($_SESSION['CountResults']); }
if (isset($_SESSION['MultipleAnswers'])) { unset($_SESSION['MultipleAnswers']); }
if (isset($_SESSION['noAnswers'])) { unset($_SESSION['noAnswers']); }

function parseMultipleChoiceString($m){
    $indexArrayOfArrays = 0;
    $temp = str_split($m);
    $numberOfOptions = 1;
    $indexOfOptions = 0;
    $index = 0;
    $tempArray = array();
    $_SESSION['OptionsArrayOfArrays'][$indexArrayOfArrays] = array();
    $currentStringValue = 0;
    $boolUserString = false;
    $largeString = "";
    foreach($temp as $char){
        if ($char == ','){
            $boolUserString = false;
            $currentStringValue = 0;
            $largeString .= implode('',$tempArray);
            $_SESSION['OptionsArrayOfArrays'][$indexArrayOfArrays][$indexOfOptions] = $largeString;
            $indexOfOptions = $indexOfOptions + 1;
            $largeString = "";
            $tempArray = array();
            if (isset($temp[$index + 1])){
                if ($temp[$index + 1] > $numberOfOptions){
                    $numberOfOptions = $temp[$index + 1];
                }
            }
        }
        else if ($char == '-'){
                    $boolUserString = true;
        }
        else if ($boolUserString == true){
                    $tempArray[$currentStringValue] = $char;
                    $currentStringValue = $currentStringValue + 1;
        }
            $index = $index + 1;
        }
    $numberOfOptions = $numberOfOptions + 1;
    $indexArrayOfArrays = $indexArrayOfArrays + 1;
    return $_SESSION['OptionsArrayOfArrays'];
}
// Pobierz id wybranej ankiety
$db = new Database();
$db->connectToDatabase();
for ($i = 0; $i < 1000; $i++){
    if (isset($_POST[$i])){
        $surveyId = $db->getSurveyIdByName($_POST[$i]);
        break;
    }
}
// Pobierz ankietę
$_SESSION['ResultsQuestion'] = $db->getSurveyQuestions($surveyId);
// Pobierz tablicę wyników ankiety
$index = 0;
$_SESSION['ResultsAnswers'] = array();
foreach ($_SESSION['ResultsQuestion'] as $question){
    $_SESSION['ResultsAnswers'][$index] = new Answer();
    $_SESSION['ResultsAnswers'][$index] = $db->getAnswers($question->getQuestionId(), $question->getQuestionTypeId());
    if($_SESSION['ResultsAnswers'][$index] == null){
        $_SESSION['noAnswers'] = "Brak odpowiedzi w tej ankiecie!";
        header('Location: ../surveyResultsShowView.php');
        exit();
    }
    $index++;
}


$indexMultipleChoice = 0;
$indexMultipleAnswer = 0;
$indexCountResults = 0;
$indexQuestion = 0;
// Sprawdzamy jakiego typu jest pytanie 
$_SESSION['MultipleChoices'] = array();
$_SESSION['CountResults'] = array();
// Dla każdego pytania w ankiecie
foreach($_SESSION['ResultsQuestion'] as $question){
    // Sprawdź typ tego pytania
    if ($question->getQuestionTypeId() == '1'){
        // Wielokrotny wybór - pobierz jakie są dostępny wybory
        $_SESSION['MultipleChoices'][$indexMultipleAnswer] = parseMultipleChoiceString($db->getMultipleString($question->GetQuestionId()));
        // Tablica przechowuje ilości odpowiedzi na daną opcję ww
        $_SESSION['CountResults'][$indexCountResults] = array();
        for ($i = 0; $i < sizeof($_SESSION['MultipleChoices'][$indexMultipleAnswer][0]); $i++){
            $_SESSION['CountResults'][$indexCountResults][$i] = 0;
        }
        // Dla każdej odpowiedzi udzielonej przez użytkownika
        foreach($_SESSION['ResultsAnswers'][$indexQuestion] as $answer){
            $temp = str_split($answer->getQuestionAnswer());
            for ($i = 0; $i < sizeof($temp); $i++){
                 $_SESSION['CountResults'][$indexCountResults][(int)$temp[$i]]++;
            }
        }
        $indexCountResults++;
        $indexMultipleAnswer++;
        $indexQuestion++;
    }
    else if($question->getQuestionTypeId() == '2'){
        // Wielokrotny wybór - pobierz jakie są dostępny wybory
        $_SESSION['MultipleChoices'][$indexMultipleAnswer] = parseMultipleChoiceString($db->getMultipleString($question->GetQuestionId()));
        // Tablica przechowuje ilości odpowiedzi na daną opcję ww
        $_SESSION['CountResults'][$indexCountResults] = array();
        for ($i = 0; $i < sizeof($_SESSION['MultipleChoices'][$indexMultipleAnswer][0]); $i++){
            $_SESSION['CountResults'][$indexCountResults][$i] = 0;
        }
        // Dla każdej odpowiedzi udzielonej przez użytkownika
        foreach($_SESSION['ResultsAnswers'][$indexQuestion] as $answer){
            $temp = str_split($answer->getQuestionAnswer());
            for ($i = 0; $i < sizeof($temp); $i++){
                 $_SESSION['CountResults'][$indexCountResults][(int)$temp[$i]]++;
            }
        }
        $indexCountResults++;
        $indexMultipleAnswer++;
        $indexQuestion++;
    }
    else if($question->getQuestionTypeId() == '3'){

        $indexQuestion++;
    }
    else if($question->getQuestionTypeId() == '4'){
        $indexQuestion++;
    }
}
header('Location: ../surveyResultsShowView.php');
exit();
?>