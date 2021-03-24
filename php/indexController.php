<?php
require('classes\Database.php');

    session_start();
    // Parsowanie adresu url
    $userUrl = $_SERVER['REQUEST_URI'];
    $urlArray = str_split($userUrl);
    $arraySurveyId = array();
    $tempIndex = 0;
    for($i = 0; $i < sizeof($urlArray); $i++){        
        if($urlArray[$i] == '.' && $urlArray[$i + 1] == 'p'
        && $urlArray[$i + 2] == 'h' && $urlArray[$i + 3] == 'p'
        && $i + 4 < sizeof($urlArray) && $urlArray[$i + 4] == '/'){
            $i = $i + 5;
            while($i < sizeof($urlArray)){
                $arraySurveyId[$tempIndex] = $urlArray[$i];
                $i = $i + 1;
                $tempIndex = $tempIndex + 1;
            }
        }
    }
    $urlSurvayId = "";
    $urlSurvayId .= implode('',$arraySurveyId);
    $temp = 0;
    if (!isset($_SESSION['ChosenSurvey'])){
        $_SESSION['ChosenSurvey'] = new Survey();
    }
    else{
        unset($_SESSION['ChosenSurvey']);
        $_SESSION['ChosenSurvey'] = new Survey();
    }

    for ($i = 0; $i < 1000; $i++){
        if (isset($_POST[$i])){
            foreach($_SESSION['ChosenSurveys'] as $survay){
                if ($survay->getSurveyName() == $_POST[$i]){
                    $_SESSION['ChosenSurvey'] = $survay;
                break;
                }
            }
            break;
        }
    }

    if (!isset($_SESSION['SurveyQuestions'])){
        $_SESSION['SurveyQuestions'] = array();
    }
    $db = new Database();
    $db->connectToDatabase();
    if ($urlSurvayId == ""){
        $_SESSION['SurveyQuestions'] = $db->getSurveyQuestions($_SESSION['ChosenSurvey']->getSurveyId());
    }
    else{
        $_SESSION['SurveyQuestions'] = $db->getSurveyQuestions($urlSurvayId);
    }
    
    if (!isset($_SESSION['OptionsArrayOfArrays'])){
        $_SESSION['OptionsArrayOfArrays'] = array(); 
    }
    else{
        unset($_SESSION['OptionsArrayOfArrays']);
        $_SESSION['OptionsArrayOfArrays'] = array(); 
    }
    $indexArrayOfArrays = 0;
    foreach($_SESSION['SurveyQuestions'] as $question){
        if($question->getQuestionTypeId() == '1'
        || $question->getQuestionTypeId() == '2'){
            $temp = $db->getMultipleString($question->getQuestionId());
            $temp = str_split($temp);
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
        }
    }
    if($urlSurvayId == ""){
        header('Location:../fillSurveyView.php');
    }
    else{
        header('Location:../../fillSurveyView.php');
    }
    exit();
?>