<?php
	session_start();
	if ((!isset($_POST['email'])) || (!isset($_POST['haslo'])))
	{
		header('Location: ../index.php');
		exit();
	}
	require('../classes/RegisteredUser.php');
	require('../classes/Database.php');
	$login = $_POST['email'];
	$haslo1 = $_POST['haslo'];
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	$db = new Database();
	$db->connectToDatabase();
	$id = $db->getUserId($login);
	if($id !== 0){
		if ($haslo1 == $db->getUserPassword($id)){
			$_SESSION['zalogowany'] = true;
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $login;
			$currentUser = new RegisteredUser($login, $haslo1, $id);
			$_SESSION['CurrentUser'] = $currentUser;
			unset($_SESSION['blad']);
			
			if($db->getUserAdminStatus($id) == true){
				$_SESSION['adminLogin'] = true;
			}
			$db->endConnection();
			header("Location: ../index.php");
		}
		else{
			$db->endConnection();
			$_SESSION['ErrorLogin'] = "Niepoprawne dane logowania!";
			header("Location: ../loginView.php");
		}
	}
	else{
		$db->endConnection();
		$_SESSION['ErrorLogin'] = "Niepoprawne dane logowania!";
		header("Location: ../loginView.php");
	}
?>