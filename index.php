<?php 
	session_start();
	
	if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true){
		header('Location: ./tasks.php');
		exit();
	}else{
		session_unset();
	}
	
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Aplikacja pozwalająca na planowanie dnia">
	<meta name="keywords" content="zadania todo aplikacja planowanie">
	<meta name="author" content="Antoni Załupka">	
	<link rel="stylesheet" href="./style/glowny.css">
	<link rel="icon" type="image/png" href="./img/favicon.png">
	<title>Lista zadań</title>
</head>
<body>
	<div id="wrapper">
		<h1>Lista zadań</h1>
		<p>Aplikacja ta pozwala na planowanie swoich codziennych zadań poprzez ich dodawanie oraz usuwanie. Naukowo udowodnione jest, że ludzki mózg lubi zorganizowaną pracę. Taka lista bardzo prosto pozwala na uporządkowanie swoich działań.</p>
		
		<div><h3>Cechy mojej aplikacji:</h3>
		<ul>
			<li>Prosta i szybka</li>
			<li>Działa zarówno na komputerach i smartfonach</li>
			<li>Zapewnia wszystkie najpotrzebniejsze funkcje</li>
			<li>Przejżysty interfejs</li>
			<li>Hasła użytkowników są bezpiecznie zahashowane</li>
			<li><b>Użyte technologie:</b> <i>HTML5, CSS3, PHP, Xampp - Apache2 oraz MySQL</i></li>
			<li><b>Autor:</b> <i>Antoni Załupka</i></li>
		</ul></div>
		<menu>
			<a href="./login.php">Logowanie</a>
			<a href="./register.php">Rejestracja</a>
		</menu>
	</div>
</body>
</html>