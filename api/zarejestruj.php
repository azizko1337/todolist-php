<?php
	session_start();
	require_once "./connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	if($polaczenie->connect_errno!=0){
		echo "Blad polaczenia z baza danych.";
	}
	else{
		if(!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['repeatpassword'])){
			header('Location: ../index.php');
			$polaczenie->close();
			exit();
		}
		
		$login = $_POST['login'];
		$password = $_POST['password'];
		$repeatpassword = $_POST['repeatpassword'];
		if($password != $repeatpassword){
			$_SESSION['rblad'] = '<span style="color: red">Hasła nie sa takie same!</span>';
			header('Location: ../register.php');
		}
		else if(!(strlen($login)>=3 && strlen($login)<=20)){
			$_SESSION['rblad'] = '<span style="color: red">Login musi mieć od 3 do 20 znaków!</span>';
			header('Location: ../register.php');
		}
		else if(!(strlen($password)>=3 && strlen($password)<=20)){
			$_SESSION['rblad'] = '<span style="color: red">Hasło musi mieć od 3 do 20 znaków!</span>';
			header('Location: ../register.php');
		}
		else if(ctype_alnum($login)==false || ctype_alnum($password)==false){
			$_SESSION['rblad'] = '<span style="color: red">Login oraz haslo nie moga zawierac znakow diakrytycznych, ani specjalnych!</span>';
			header('Location: ../register.php');
		}
		else{
			if($rezultat = @$polaczenie->query(
				sprintf("SELECT * FROM uzytkownik WHERE login='%s'", 
				mysqli_real_escape_string($polaczenie, $login)
			))){
				$ilu_userow = $rezultat->num_rows;
				if($ilu_userow == 0){
					//DODAWANIE UŻYTNOWNIKA
					$hpassword = password_hash($password, PASSWORD_DEFAULT);
					if($polaczenie->query("INSERT INTO uzytkownik (Login, Password) VALUES ('$login', '$hpassword')")){
						$_SESSION['blad'] = '<span style="color: green">Konto utworzone, możesz się zalogować :)</span>';
						header('Location: ../login.php');
					}
					else{
						$_SESSION['rblad'] = '<span style="color: red">Blad po stronie serwera, nie udalo sie zarejestrowac.</span>';
						header('Location: ../register.php');
					}
				}
				else{
					$_SESSION['rblad'] = '<span style="color: red">Użytkownik o takim loginie jest już zarejestrowany.</span> <br> <a style="position:static; display:block; height:auto; width:100%; text-align:center; text-transform:none; margin:0; padding:0; background:transparent; color:cadetblue; text-decoration:none;" href="./login.php">Przejdź na stronę logowania</a>';
					header('Location: ../register.php');
				}
			}
		}
		
		$polaczenie->close();
	}
?>