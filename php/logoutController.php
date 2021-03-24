<?php
	session_start();
	if (isset($_SESSION['CurrentUser'])) unset($_SESSION['CurrentUser']);
	session_unset();
	header('Location: ../index.php');
?>