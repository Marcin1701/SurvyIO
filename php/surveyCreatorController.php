<?php
    require('classes\Database.php');
    require('classes\registeredUser.php');
    session_start();
    // Jeśli nie jest zalogowany - przekieruj do logowania
    if (!isset($_SESSION['CurrentUser']))
        header('Location: ../loginView.php');
    // Sprawdź nazwę ankiety
    $check = $_POST['sName'];
    if($check == ''){
      $_SESSION['eSurveyName'] = "Podaj nazwę ankiety!";
      header('Location: ../surveyCreatorView.php');
      exit();
    }
    $check = (int)$_POST['privacy'];
    if (!isset($_POST['privacy'])){
      $_SESSION['ePrivacy'] = "Wybierz opcję udostępniania!";
      header('Location: ../surveyCreatorView.php');
      exit();
    }
    // Wybrana kategoria
    $surveyCategory = $_POST['category'];
    // Podłącz do bazy danych
    $db = new Database();
    $db->connectToDatabase();
    // Ustaw widoczność ankiety
    $surveyPrivacy = $_POST['privacy'];
    if ($_POST['privacy'] == "publ"){
      $surveyPrivacy = 1;
    }else{
      $survyeyPrivacy = 0;
    }
    // Stwórz obiekt ankiety jako zmienną sesyjną
    $_SESSION['CurrentSurvey'] = new Survey();
    $_SESSION['CurrentSurvey']->setSurveyName($_POST['sName']);
    $_SESSION['CurrentSurvey']->setStartDate(date('Y-m-d'));
    $_SESSION['CurrentSurvey']->setEndDate($_POST['eDay']);
    $_SESSION['CurrentSurvey']->setVisibility($surveyPrivacy);
    $_SESSION['CurrentSurvey']->setCreatorId($_SESSION['CurrentUser']->id);
    $_SESSION['CurrentSurvey']->setCategoryId($db->getCategoryId($_POST['category']));
    // Dodaj ankietę do bazy danych
    $db->addSurveyToDatabase(
      $_SESSION['CurrentSurvey']->getSurveyName(),
      $_SESSION['CurrentSurvey']->getStartDate(),
      $_SESSION['CurrentSurvey']->getEndDate(),
      $_SESSION['CurrentSurvey']->getVisibility(),
      $_SESSION['CurrentSurvey']->getCreatorId(),
      $_SESSION['CurrentSurvey']->getCategoryId()
    );
    // Pobierz Id ankiety z bazy danych
    $_SESSION['CurrentSurvey']->setSurveyId($db->getSurveyIdByName($_SESSION['CurrentSurvey']->getSurveyName()));
    // Usuń ankietę z bazy danych
    $db->deleteSurveyById($_SESSION['CurrentSurvey']->getSurveyId());
    // Przekieruj do podstrony z tworzeniem pytań
    header('Location: ../questionView.php');
?>