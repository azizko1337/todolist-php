<?php
	session_start();
	require_once "./connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if($polaczenie->connect_errno!=0){
		echo "Blad polaczenia z baza danych.";
	}
	else{
		if(!isset($_POST['login']) || !isset($_POST['password'])){
			header('Location: ../index.php');
			exit();
		}
		$login = $_POST['login'];
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
		
		if($rezultat = @$polaczenie->query(
			sprintf("SELECT * FROM uzytkownik WHERE login='%s'", 
			mysqli_real_escape_string($polaczenie, $login), 
		))){
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow == 1){
				$wiersz = $rezultat->fetch_assoc();
				if(password_verify($password, $wiersz['Password'])){
					$_SESSION['user'] = $wiersz['ID'];
					$_SESSION['zalogowany'] = true;
					
					unset($_SESSION['blad']);
					header('Location: ../tasks.php');
				}
				else{
					$_SESSION['blad'] = '<span style="color: red">Złe hasło!</span>';
					header('Location: ../login.php');
				}
				$rezultat->close();
			}
			else{
				$_SESSION['blad'] = '<span style="color: red">Zły login!</span>';
				header('Location: ../login.php');
			}
		}
		else{
			
		}
		
		$polaczenie->close();
	}
?>