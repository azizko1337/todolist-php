<?php
	session_start();
	require_once "./connect.php";

	
	if(!isset($_GET['zadanie'])){
		header('Location: ../index.php');
		exit();
	}
	if(!isset($_SESSION['zalogowany'])){
		header('Location: ../index.php');		
		exit();
	}

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if($polaczenie->connect_errno!=0){
		echo "Blad polaczenia z baza danych.";
	}
	else{
		$userID = $_SESSION['user'];
		$taskID = $_GET['zadanie'];
		
		if($polaczenie->query("DELETE FROM zadanie WHERE id=$taskID AND author=$userID")){
			$_SESSION['tblad'] = '<span style="color: green">Zadanie zostalo pomyslnie usuniete :)</span>';
			header('Location: ../tasks.php');
		}
		else{
			$_SESSION['tblad'] = '<span style="color: red">Blad serwera, nie udalo sie usunac zadania!</span>';
			header('Location: ../tasks.php');
		}

		$polaczenie->close();
	}
?>