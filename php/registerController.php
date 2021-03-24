<?php

session_start();
require('classes\Database.php');

$tests = true;
// Pobierz i sprawdź adres e-mail
$email = $_POST['email'];
$checkEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
if ((filter_var($checkEmail, FILTER_VALIDATE_EMAIL) == false) || ($email != $email)){
    $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
    $tests = false;
}

$email = strtolower($email);

// Pobierz i sprawdź hasła
$passw1 = $_POST['haslo1'];
$passw2 = $_POST['haslo2'];
if ($passw1 != $passw2){
    $_SESSION['e_haslo'] = "Podane hasła nie są identyczne!";
    $tests = false;
}

try{
    $db = new Database();
    $db->connectToDatabase();
    $tempId = $db->getUserId($email);
    if ($tempId == 0){
        if (($tests == true) && ($db->insertNewUser($email, $passw1) == true)){
            $_SESSION['udanarejestracja'] = true;
           // $db->endConnection();
            header('Location: ../loginView.php');
        }
        else{
          //  $db->endConnection();
            header('Location: ../registerView.php');
        }
    }
    else{
        $_SESSION['e_email'] = "Istnieje konto o takim adresie!";
        $tests = false;
        header('Location: ../registerView.php');
    }
}
catch(Exception $e){
    echo "Błąd serwera!";
}

?>