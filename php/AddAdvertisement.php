<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="form">
			<form id="iragarkia" name="iragarkia" action="#" method="post" enctype='multipart/form-data'>
				<fieldset>
					<legend>
						<h2>Iragarkia gehitu</h2>
					</legend>
					<label for="category">Kategoria(*):</label>
					<select name="category">
						<option value="Ibilgailuak">Ibilgailuak</option>
						<option value="Eraikuntzak">Eraikuntzak</option>
						<option value="Lana">Lana</option>
						<option value="Heziketa">Heziketa</option>
						<option value="Zerbitzuak">Zerbitzuak</option>
						<option value="Negozioak">Negozioak</option>
						<option value="Informatika">Informatika</option>
						<option value="Ikus-entzunezkoak">Ikus-entzunezkoak</option>
						<option value="Telefonia">Telefonia</option>
						<option value="Jokoak">Jokoak</option>
						<option value="Etxetresnak">Etxetresnak</option>
						<option value="Moda">Moda</option>
						<option value="Umeak">Umeak</option>
						<option value="Zaletasunak">Zaletasunak</option>
						<option value="Kirolak">Kirolak</option>
						<option value="Maskotak">Maskotak</option>
					</select>
					<br><br>
					<label for="title">Titulua(*):</label>
					<input type="text" id="title" name="title" minlength="5" required>
					<br><br>
					<label for="text">Textua(*):</label>
					<textarea id="text" name="text" cols="40" rows="5" minlength="10" required></textarea>
					<br><br>
					<label for="price">Prezioa(*):</label>
					<input type="number" id="price" name="price" min="0" required>
					<br><br>
					<label for="city">Hiria(*):</label>
					<input type="text" id="city" name="city" required>
					<br><br>
					<label for="images">Argazkia(k) aukeratu(*):</label>
					<input type="file" id="images" name="images[]" accept="image/*" multiple required>
					<br><br>
					<input type="submit" id="submit" value="Iragarkia gehitu">
					<input type="reset" value="Berrezarri">
				</fieldset>
			</form>

			<?php
			if (isset($_POST["category"])) {
				$category = trim($_POST["category"]);
				$title = trim($_POST["title"]);
				$text = trim($_POST["text"]);
				$price = trim($_POST["price"]);
				$city = trim($_POST["city"]);

				if (empty($category) || empty($title) || empty($text) || empty($price) || empty($city)) {
					echo "<script>alert('Bete eremu guztiak'); history.go(-1);</script>";
				}
				else if (strlen($title) < 5) {
					echo "<script>alert('Tituluak gutxienez 5 karaktere izan behar ditu'); history.go(-1);</script>";
				}
				else if (strlen($text) < 10) {
					echo "<script>alert('Testuak gutxienez 10 karaktere izan behar ditu'); history.go(-1);</script>";
				}
				else if ($price < 0) {
					echo "<script>alert('Prezioak ezin du negatiboa izan'); history.go(-1);</script>";
				}
				else {
					// Count # of uploaded files in array
					$total = count($_FILES['images']['name']);

					if ($total == 0) {
						echo "<script>alert('Gutxienez argazki 1 aukeratu behar da'); history.go(-1);</script>";
					}
					else if ($total > 5) {
						echo "<script>alert('Gehienez 5 argazki aukera daitezke'); history.go(-1);</script>";
					}
					else {
						include '../php/DbConfig.php';
						$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
					
						$sql = "SELECT AUTO_INCREMENT
						FROM information_schema.TABLES
						WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = 'ads'";
						
						$result = mysqli_query($link, $sql);

						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						$id = $row['AUTO_INCREMENT'];
						$directory = '../images/'.$id.'/';

						if (!file_exists($directory) && mkdir($directory, 0777, true)) {
							// Loop through each file
							for($i=0 ; $i < $total ; $i++) {
								//Get the temp file path
								$tmpFilePath = $_FILES['images']['tmp_name'][$i];

								//Make sure we have a file path
								if ($tmpFilePath != ""){
									//Setup our new file path
									$newFilePath = $directory.$_FILES['images']['name'][$i];

									//Upload the file into the temp dir
									if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
										echo "<script>alert('Erroreren bat egon da argazkiak gordetzean'); history.go(-1);</script>";
										exit();
									}
								}
							}
						}

						$email = $_SESSION['email'];

						date_default_timezone_set('Europe/Madrid');
						$date = date('Y-m-d H:i:s');

						$sql = "INSERT INTO ads VALUES ($id, '$email', '$title', '$category', '$text', 
						$price, '$city', '$directory', '$date')";
						
						$emaitza = mysqli_query($link, $sql);

						mysqli_close($link);

						if (!$emaitza) {
							echo "<script>alert('Iruzkina ez da ondo gorde datu-basean'); history.go(-1);</script>";
						} else {
							echo "<script>alert('Iruzkina ondo gorde da datu-basean');</script>";
						}
					}
				}
			}
            ?>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>