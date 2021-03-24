<?php

require('Survey.php');
require('Question.php');
require('Answer.php');

class Database {
    private $connection;
    private $host = "localhost";
    // Connection properties
	private $db_user = "";
	private $db_password = "";
	private $db_name = "";
    private $queryResult;

    public function connectToDatabase(){
        $this->connection = @new mysqli($this->host, $this->db_user, $this->db_password, $this->db_name);
        if ($this->connection->connect_errno != 0){
            echo "Connection Error: ".$this->connecion->connect_errno;
        }
    }

    public function getUserId($email){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM uzytkownik WHERE email='$email'",
            mysqli_real_escape_string($this->connection, $email)));
        $returnedRow = $queryResult->fetch_assoc();
        if (!(isset($returnedRow['id_uzytkownika']))){
            $queryResult->free_result();
            return 0;
        }
        else{
            $userId =  $returnedRow['id_uzytkownika'];
            $queryResult->free_result();
            return $userId;
        }
    }

    public function getUserPassword($id){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM uzytkownik WHERE id_uzytkownika='$id'",
            mysqli_real_escape_string($this->connection, $id)));
        $returnedRow = $queryResult->fetch_assoc();
        if ($returnedRow['haslo'] == NULL){
            $queryResult->free_result();
            return 0;
        }
        else{
            $userPassword = $returnedRow['haslo'];
            $queryResult->free_result();
            return $userPassword;
        }
    }

    public function insertNewUser($email, $password){
        $this->connection->query("INSERT INTO uzytkownik(email,haslo) VALUES ('$email','$password')");
        return true;
    }

    public function addSurveyToDatabase($surveyName, $startDate, $endDate, $isVisible, $idCreator, $idCategory){
        $this->connection->query("INSERT INTO ankieta(nazwa_ankiety,data_rozp_ankiety,data_zak_ankiety,czy_widoczna,id_tworcy,id_kategorii) VALUES ('$surveyName','$startDate','$endDate','$isVisible','$idCreator','$idCategory');");
        return true; 
    }

    public function getUserSurveyIds($userId){
        $queryResult = @$this->connection->query(
            sprintf("SELECT kategoria.nazwa_kategorii FROM ankieta,kategoria  WHERE id_tworcy='$userId'", mysqli_real_escape_string($this->connection, $userId)));
        $returnedRow = $queryResult->fetch_assoc();
        $surveyIds = $returnedRow['id_ankiety'];
        $queryResult->free_result();
        return $surveyIds;
    }

    public function getCategoryId($categoryName){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM kategoria WHERE nazwa_kategorii='$categoryName'", mysqli_real_escape_string($this->connection,$categoryName)));
        $returnedRow = $queryResult->fetch_assoc();
        $catId = $returnedRow['id_kategorii'];
        $queryResult->free_result();
        return $catId;
    }

    public function endConnection(){
        $this->connection->close();
    }
    
    public function getSurveyNamesByCategoryName($categoryName){
        $queryResult = @$this->connection->query(
            sprintf("SELECT ankieta.id_ankiety, ankieta.nazwa_ankiety, ankieta.data_rozp_ankiety, ankieta.data_zak_ankiety, ankieta.czy_widoczna, ankieta.id_tworcy, ankieta.id_kategorii  FROM ankieta,kategoria WHERE ankieta.id_kategorii=kategoria.id_kategorii AND kategoria.nazwa_kategorii='$categoryName'",mysqli_real_escape_string($this->connection,$categoryName)));
        $index = 0;
        if ($queryResult->num_rows == 0){
            $queryResult->free_result();
            return 0;
        }
        while($row = $queryResult->fetch_array()){
            if (($row['czy_widoczna'] == 1) && ($row['data_zak_ankiety'] > date('Y-m-d'))){
                $surveys[] = new Survey();
                $surveys[$index]->setSurveyId($row['id_ankiety']);
                $surveys[$index]->setSurveyName($row['nazwa_ankiety']);
                $surveys[$index]->setStartDate($row['data_rozp_ankiety']);
                $surveys[$index]->setEndDate($row['data_zak_ankiety']);
                $surveys[$index]->setVisibility($row['czy_widoczna']);
                $surveys[$index]->setCreatorId($row['id_tworcy']);
                $surveys[$index]->setCategoryid($row['id_kategorii']);
                $index = $index + 1;
            }
        }
        $queryResult->free_result();
        return $surveys;
    }

    public function deleteSurveyById($surveyId){
        $this->connection->query("DELETE FROM ankieta WHERE id_ankiety='$surveyId'");
        return true;
    }

    public function getSurveyIdByName($surveyName){
        $queryResult = @$this->connection->query(
            sprintf("SELECT id_ankiety FROM ankieta WHERE nazwa_ankiety='$surveyName'",mysqli_real_escape_string($this->connection,$surveyName)));
        $returnedRow = $queryResult->fetch_row();
        $surveyId = $returnedRow['0'];
        return $surveyId;
    }

    public function addNewQuestion($questionText, $idQuestionType, $surveyId, $min, $max, $possibleChoices, $optionsText){
        if (!$possibleChoices){
            $this->connection->query("INSERT INTO pytanie(tresc_pytania,id_typu_pytania,id_ankiety,zakres_min,zakres_max) VALUES ('$questionText','$idQuestionType','$surveyId','$min','$max');");
        }
        else{
            $this->connection->query("INSERT INTO pytanie(tresc_pytania,id_typu_pytania,id_ankiety,zakres_min,zakres_max) VALUES ('$questionText','$idQuestionType','$surveyId','$min','$max');");
            $queryResult = @$this->connection->query(
                sprintf("SELECT * FROM pytanie WHERE id_ankiety='$surveyId' AND id_typu_pytania='$idQuestionType' AND tresc_pytania='$questionText'",mysqli_real_escape_string($this->connection, $surveyId)));
            $returnedRow = $queryResult->fetch_row();
            $QuestionId = $returnedRow['0'];
            $this->connection->query("INSERT INTO mozliwe_wybory(id_pytania,tresc_opcji) VALUES ('$QuestionId','$optionsText');");
        }
        return true;
    }

    public function getSurveyQuestions($surveyId){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM pytanie WHERE id_ankiety='$surveyId'", mysqli_real_escape_string($this->connection, $surveyId)));
        $index = 0;
        if ($queryResult->num_rows == 0){
            $queryResult->free_result();
            return 0;
        }
        while($row = $queryResult->fetch_array()){
                $surveys[] = new Question();
                $surveys[$index]->setQuestionId($row['id_pytania']);
                $surveys[$index]->setQuestionText($row['tresc_pytania']);
                $surveys[$index]->setQuestionTypeId($row['id_typu_pytania']);
                $surveys[$index]->setSurveyId($row['id_ankiety']);
                $surveys[$index]->setMin($row['zakres_min']);
                $surveys[$index]->setMax($row['zakres_max']);
                $index = $index + 1;
        }
        $queryResult->free_result();
        return $surveys;
    }

    public function getMultipleString($questionId){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM mozliwe_wybory WHERE id_pytania='$questionId'", mysqli_real_escape_string($this->connection, $questionId)));
        $row = $queryResult->fetch_row();
        $multipleString = $row['2'];
        return $multipleString;
    }

    public function addMultipleAnswerQuestion($questionId, $answer){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM mozliwe_wybory WHERE id_pytania='$questionId'", mysqli_real_escape_string($this->connection, $questionId)));
        $row = $queryResult->fetch_row();
        $choiceId = $queryResult = $row['0'];
        $this->connection->query("INSERT INTO wielo_krot_wybor(tresc_odp,id_wyboru) VALUES ('$answer','$choiceId')");
        return true;
    }

    public function addSingleAnswerQuestion($questionId, $answer){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM mozliwe_wybory WHERE id_pytania='$questionId'", mysqli_real_escape_string($this->connection, $questionId)));
        $row = $queryResult->fetch_row();
        $choiceId = $queryResult = $row['0'];
        $this->connection->query("INSERT INTO jed_krot_wybor(tresc_odp,id_wyboru) VALUES ('$answer','$choiceId')");
        return true; 
    }

    public function addTextAnswerQuestion($questionId, $answer){
        $this->connection->query("INSERT INTO odp_tekstowa(tresc_odp,id_pytania) VALUES ('$answer','$questionId')");
        return true;
    }

    public function addRangeAnswerQuestion($questionId, $answer){
        $this->connection->query("INSERT INTO zakres_wybor(tresc_odp,id_pytania) VALUES ('$answer','$questionId')");
        return true;
    }

    public function getSurveysByUserId($userId){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM ankieta WHERE id_tworcy='$userId'", mysqli_real_escape_string($this->connection, $userId)));
        $index = 0;
        if ($queryResult->num_rows == 0){
            $queryResult->free_result();
            return 0;
        }
        while($row = $queryResult->fetch_array()){
                $surveys[] = new Survey();
                $surveys[$index]->setSurveyId($row['id_ankiety']);
                $surveys[$index]->setSurveyName($row['nazwa_ankiety']);
                $surveys[$index]->setStartDate($row['data_rozp_ankiety']);
                $surveys[$index]->setEndDate($row['data_zak_ankiety']);
                $surveys[$index]->setVisibility($row['czy_widoczna']);
                $surveys[$index]->setCreatorId($row['id_tworcy']);
                $surveys[$index]->setCategoryId($row['id_kategorii']);
                $index = $index + 1;
        }
        $queryResult->free_result();
        return $surveys;
    }

    public function getAnswers($idQuestion, $idType){
        $index = 0;
        $answer = array();
        if ($idType == '1'){
            // ww
            $queryResult = @$this->connection->query(
                sprintf("SELECT * FROM mozliwe_wybory WHERE id_pytania = '$idQuestion'",
                mysqli_real_escape_string($this->connection, $idQuestion)));
            $row = $queryResult->fetch_row();
            $idChoice = $row['0'];
            $queryResult = @$this->connection->query(
                sprintf("SELECT tresc_odp FROM wielo_krot_wybor WHERE id_wyboru  = '$idChoice'",
                mysqli_real_escape_string($this->connection, $idChoice)));
        }
        else if($idType == '2'){
             $queryResult = @$this->connection->query(
                sprintf("SELECT * FROM mozliwe_wybory WHERE id_pytania = '$idQuestion'",
                mysqli_real_escape_string($this->connection, $idQuestion)));
            $row = $queryResult->fetch_row();
            $idChoice = $row['0'];
            $queryResult = @$this->connection->query(
                sprintf("SELECT tresc_odp FROM jed_krot_wybor WHERE id_wyboru = '$idChoice'",
                mysqli_real_escape_string($this->connection, $idChoice)));
        }
        else if($idType == '3'){
            $queryResult = @$this->connection->query(
                sprintf("SELECT tresc_odp FROM odp_tekstowa where id_pytania = '$idQuestion'", mysqli_real_escape_string($this->connection, $idQuestion)));
        }
        else if($idType == '4'){
            $queryResult = @$this->connection->query(
                sprintf("SELECT tresc_odp FROM zakres_wybor where id_pytania = '$idQuestion'", mysqli_real_escape_string($this->connection, $idQuestion)));
        }
        while ($row = $queryResult->fetch_array()){
            $answer[$index] = new Answer();
            $answer[$index]->setQuestionTypeId($idType);
            $answer[$index]->setQuestionAnswer($row['tresc_odp']);
            $index++;
        }
        return $answer;
    }

    public function updateUserPassword($userId, $userPassword){
        $this->connection->query(
            "UPDATE uzytkownik SET haslo='$userPassword' WHERE id_uzytkownika='$userId'"
        );
        return true;
    }

    public function updateUserEmail($userId, $userEmail){
        $this->connection->query(
            "UPDATE uzytkownik SET email='$userEmail' WHERE id_uzytkownika='$userId'"
        );
        return true;
    }

    public function deleteUser($userId){
        $this->connection->query(
            "DELETE FROM uzytkownik WHERE id_uzytkownika='$userId'"
        );
        return true;
    }

    public function getUserAdminStatus($userId){
        $queryResult = @$this->connection->query(
            sprintf("SELECT * FROM uzytkownik WHERE id_uzytkownika = '$userId'", mysqli_real_escape_string($this->connection, $userId)));
        $row = $queryResult->fetch_row();
        if ($row['3'] == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function hideSurvey($surveyId){
        $this->connection->query(
            "UPDATE ankieta SET czy_widoczna = 0  WHERE id_ankiety='$surveyId'"
        );
        return true;
    }
}

?>