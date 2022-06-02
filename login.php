<?php
	session_start();
	
	if(isset($_SESSION['zalogowany']) && $_SESSION['zalogowany']==true){
		header('Location: ./tasks.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/logowanie.css">
	<link rel="icon" type="image/png" href="./img/favicon.png">
	<title>Logowanie</title>
	<meta name="description" content="Aplikacja pozwalaj�ca na planowanie dnia">
	<meta name="keywords" content="zadania todo aplikacja planowanie">
	<meta name="author" content="Antoni Za�upka">
</head>
<body>
	<div id="wrapper">
		<a href="./index.php">Powrót do strony głównej</a>
		<h3>Formularz logowania</h3>
		<form action="./api/zaloguj.php" method="POST">
			<label for="login">Login</label>
			<input name="login" type="text"><br>
			<label for="password">Hasło</label>
			<input name="password" type="password"><br>
			<input type="submit" value="Zaloguj">
			<?php
				if(isset($_SESSION['blad'])){
					$blad = $_SESSION['blad'];
					echo $blad;
				}
			?>
		</form>
	</div>
</body>
</html>