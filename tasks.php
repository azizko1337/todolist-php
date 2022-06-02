<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany'])){
		header('Location: ./index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./style/zadania.css">
	<link rel="icon" type="image/png" href="./img/favicon.png">
	<title>Zadania</title>
	<meta name="description" content="Aplikacja pozwalaj�ca na planowanie dnia">
	<meta name="keywords" content="zadania todo aplikacja planowanie">
	<meta name="author" content="Antoni Za�upka">
</head>
<body>
	<div id="wrapper">
		<a href="./api/wyloguj.php">Kliknij, aby się wylogować</a>
		<button class="menuButton">Formularz nowego zadania</button>
		<form action="./api/dodajzadanie.php" method="POST">
			<label for="title">Tytuł</label>
			<input type="text" name="title"><br>
			<label for="description">Opis</label>
			<input type="text" name="description"><br>
			<input type="submit" value="Dodaj nowe zadanie">
			<?php
				if(isset($_SESSION['tblad'])){
					$blad = $_SESSION['tblad'];
					echo $blad;
				}
			?>
			<button class="menuButton">Zamknij formularz</button>
		</form>
		<h1>Zadania:</h1>
		<span>(Kliknij na zadanie, aby je usunąć)</span>
		
		<?php
			require_once "./api/connect.php";
			$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
			if($polaczenie->connect_errno!=0){
				echo "Blad polaczenia z baza danych.";
			}
			else{
				$userID = $_SESSION['user'];
				if($rezultat = @$polaczenie->query("SELECT * FROM zadanie WHERE author=$userID")){
					while($wiersz = $rezultat->fetch_assoc()){
						echo '<div id="'.$wiersz['ID'].'" class="task">';
							echo '<h3>'.$wiersz['title'].'</h3>';
							echo '<p>'.$wiersz['description'].'</p>';
						echo '</div>';
					}
				}
				else{
					
				}
			}
		?>
		
	</div>
	<script>
		const tasks = document.querySelectorAll(".task");
		tasks.forEach(task => task.addEventListener("click", async () => {
			const { id } = task;
			window.location.href = `./api/usunzadanie.php?zadanie=${id}`;
		}))

		const menuButtons = document.querySelectorAll(".menuButton");
		const newTaskForm = document.querySelector("form");
		
		menuButtons.forEach(button => button.addEventListener("click", e => {
			e.preventDefault();
			newTaskForm.classList.toggle("active");
		}))
	</script>
</body>
</html>