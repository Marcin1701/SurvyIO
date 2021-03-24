<?php

class Answer{
    private $questionTypeId;
    private $answerValue;

public function setQuestionTypeId($_questionTypeId){
    $this->questionTypeId = $_questionTypeId;
}

public function getQuestionTypeId(){
    return $this->questionTypeId;
}

public function setQuestionAnswer($_answerValue){
    $this->answerValue = $_answerValue;
}

public function getQuestionAnswer(){
    return $this->answerValue;
}
}

?>