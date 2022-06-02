<?php
	session_start();
	require_once "./connect.php";

	if(!isset($_POST['title']) || !isset($_POST['description'])){
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
		$title = $_POST['title'];
		$description = $_POST['description'];
		
		if(!(strlen($title)>=1 && strlen($title)<=30)){
			$_SESSION['tblad'] = '<span style="color: red">Tytul zadania musi miec od 1 do 30 znakow!</span>';
			header('Location: ../tasks.php');
		}
		else if(!(strlen($description)>=1 && strlen($description)<=100)){
			$_SESSION['tblad'] = '<span style="color: red">Opis musi mieć od 1 do 100 znakow!</span>';
			header('Location: ../tasks.php');
		}
		else{
			if($polaczenie->query("INSERT INTO zadanie (author, title, description) VALUES ('$userID', '$title', '$description')")){
				$_SESSION['tblad'] = '<span style="color: green">Zadanie zostalo pomyslnie dodane :)</span>';
				header('Location: ../tasks.php');
			}
			else{
				$_SESSION['tblad'] = '<span style="color: red">Blad serwera, nie udalo sie dodac zadania!</span>';
				header('Location: ../tasks.php');
			}
		}
		
		$polaczenie->close();
	}
?>