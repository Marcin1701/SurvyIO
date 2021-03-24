<?php

class Survey {
    private $id;
    private $surveyName;
    private $startDate;
    private $endDate;
    private $isVisible;
    private $idCreator;
    private $idCategory;

public function __constructor($_id, $_surveyName, $_startDate, $_endDate, $_isVisible, $_idCreator){
    $this->id = $_id;
    $this->$surveyName = $_surveyName;
    $this->startDate = $_startDate;
    $this->endDate = $_endDate;
    $this->isVisible = $_isVisible;
    $this->idCreator = $_idCreator;
}

public function getSurveyId(){
    return $this->id;
}

public function setSurveyId($_id){
$this->id = $_id;
}

public function getSurveyName(){
    return $this->surveyName;
}

public function setSurveyName($_surveyName){
    $this->surveyName = $_surveyName;
}

public function getStartDate(){
    return $this->startDate;
}

public function setStartDate($_startDate){
    $this->startDate = $_startDate;
}

public function getEndDate(){
    return $this->endDate;
}

public function setEndDate($_endDate){
    $this->endDate = $_endDate;
}

public function getVisibility(){
    return $this->isVisible;
}

public function setVisibility($_isVisible){
    $this->isVisible = $_isVisible;
}

public function getCreatorId(){
    return $this->idCreator;
}

public function setCreatorId($_idCreator){
    $this->idCreator = $_idCreator;
}

public function getCategoryId(){
    return $this->idCategory;
}

public function setCategoryId($_categoryId){
    $this->idCategory = $_categoryId;
}

}

?>