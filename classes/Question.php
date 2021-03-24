<?php
class Question{
    private $questionId;
    private $questionText;
    private $questionTypeId;
    private $surveyId;
    private $min;
    private $max;
    private $multipleChoiceString;

public function __constructor($_questionId, $_questionText, $_questionTypeId, $_surveyId){
    $this->questionId = $_questionId;
    $this->questionText = $_questionText;
    $this->questionTypeId = $_questionTypeId;
    $this->surveyId = $_surveyId;
}

public function getQuestionId(){
    return $this->questionId;
}

public function setQuestionId($_questionId){
    $this->questionId = $_questionId;
}

public function getQuestionText(){
    return $this->questionText;
}

public function setQuestionText($_questionText){
    $this->questionText = $_questionText;
}

public function getQuestionTypeId(){
    return $this->questionTypeId;
}

public function setQuestionTypeId($_questionTypeId){
    $this->questionTypeId = $_questionTypeId;
}

public function getSurveyId(){
    return $this->surveyId;
}

public function setSurveyId($_surveyId){
    $this->surveyId = $_surveyId;
}

public function setMin($_min){
    $this->min = $_min;
}

public function getMin(){
    return $this->min;
}

public function setMax($_max){
    $this->max = $_max;
}

public function getMax(){
    return $this->max;
}

public function setMultipleChoiceString($_mcs){
    $this->multipleChoiceString = $_mcs;
}

public function getMultipleChoiceString(){
    return $this->multipleChoiceString;
}

}

?>