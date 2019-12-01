<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<?php
	include '../php/DbConfig.php';
	$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

	$ad_id = trim($_GET["ad_id"]);

	$sql = "SELECT * FROM ads WHERE ad_id='$ad_id'";
	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
		
	while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
		$category = trim($row["category"]);
		$title = trim($row["title"]);
		$text = trim($row["text"]);
		$price = trim($row["price"]);
		$city = trim($row["city"]);
	}
	
	mysqli_free_result($emaitza);
	mysqli_close($esteka);
	?>
	<div class="main">
		<div id="form">
			<form id="iragarkia" name="iragarkia" method="post" enctype='multipart/form-data'>
				<fieldset>
					<legend>
						<h2>Iragarkia editatu</h2>
					</legend>
					<label for="category">Kategoria(*):</label>
					<select id="category" name="category" required>
						<option value="Ibilgailuak" <?php if($category=='Ibilgailuak') echo 'selected'; ?>>Ibilgailuak
						</option>
						<option value="Eraikuntzak" <?php if($category=='Eraikuntzak') echo 'selected'; ?>>Eraikuntzak
						</option>
						<option value="Lana" <?php if($category=='Lana') echo 'selected'; ?>>Lana</option>
						<option value="Heziketa" <?php if($category=='Heziketa') echo 'selected'; ?>>Heziketa
						</option>
						<option value="Zerbitzuak" <?php if($category=='Zerbitzuak') echo 'selected'; ?>>Zerbitzuak
						</option>
						<option value="Negozioak" <?php if($category=='Negozioak') echo 'selected'; ?>>Negozioak
						</option>
						<option value="Informatika" <?php if($category=='Informatika') echo 'selected'; ?>>Informatika
						</option>
						<option value="Ikus-entzunezkoak" <?php if($category=='Ikus-entzunezkoak') echo 'selected'; ?>>
							Ikus-entzunezkoak</option>
						<option value="Telefonia" <?php if($category=='Telefonia') echo 'selected'; ?>>Telefonia
						</option>
						<option value="Jokoak" <?php if($category=='Jokoak') echo 'selected'; ?>>Jokoak</option>
						<option value="Etxetresnak" <?php if($category=='Etxetresnak') echo 'selected'; ?>>Etxetresnak
						</option>
						<option value="Moda" <?php if($category=='Moda') echo 'selected'; ?>>Moda</option>
						<option value="Umeak" <?php if($category=='Umeak') echo 'selected'; ?>>Umeak</option>
						<option value="Zaletasunak" <?php if($category=='Zaletasunak') echo 'selected'; ?>>Zaletasunak
						</option>
						<option value="Kirolak" <?php if($category=='Kirolak') echo 'selected'; ?>>Kirolak</option>
						<option value="Maskotak" <?php if($category=='Maskotak') echo 'selected'; ?>>Maskotak
						</option>
					</select>
					<br><br>
					<label for="title">Titulua(*):</label>
					<input type="text" id="title" name="title" minlength="5" maxlength="100"
						value="<?php echo $title; ?>" required>
					<br><br>
					<label for="text">Testua(*):</label>
					<br>
					<textarea id="text" name="text" cols="40" rows="5" minlength="10" maxlength="1000"
						required><?php echo $text; ?></textarea>
					<br><br>
					<label for="price">Prezioa(*):</label>
					<input type="number" id="price" name="price" min="0" value="<?php echo $price; ?>" required>
					<br><br>
					<label for="city">Hiria(*):</label>
					<input type="text" id="city" name="city" value="<?php echo $city; ?>" required>
					<br><br>
					<label for="images">Argazkia(k) aukeratu(*):</label>
					<input type="file" id="images" name="images[]" accept="image/*" multiple required>
					<br><br>
					<input type="submit" id="submit" value="Iragarkia editatu">
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
				else if (strlen($title) > 100) {
					echo "<script>alert('Tituluak gehienez 100 karaktere izan ditzake'); history.go(-1);</script>";
				}
				else if (strlen($text) < 10) {
					echo "<script>alert('Testuak gutxienez 10 karaktere izan behar ditu'); history.go(-1);</script>";
				}
				else if (strlen($text) > 1000) {
					echo "<script>alert('Testuak gehienez 1000 karaktere izan ditzake'); history.go(-1);</script>";
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

						$directory = '../images/ads/'.$ad_id.'/';

						if (file_exists($directory) || mkdir($directory, 0777, true)) {
							// Loop through each file
							for($i=0 ; $i < $total ; $i++) {
								//Get the temp file path
								$tmpFilePath = $_FILES['images']['tmp_name'][$i];

								//Make sure we have a file path
								if ($tmpFilePath != ""){
									//Setup our new file path
									//$newFilePath = $directory.$_FILES['images']['name'][$i];
									$name = $_FILES["images"]["name"][$i];
									$tmp = explode(".", $name);
									$extension = end($tmp);
									$newFilePath = $directory."image".$i.".".$extension;
									//Upload the file into the temp dir
									if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
										echo "<script>alert('Erroreren bat egon da argazkiak gordetzean'); history.go(-1);</script>";
										exit();
									}
								}
							}
						}

						$sql = "UPDATE ads SET title='$title', category='$category', text='$text', 
						price=$price, city='$city' WHERE ad_id=$ad_id";
						
						$emaitza = mysqli_query($link, $sql);

						mysqli_close($link);

						if (!$emaitza) {
							echo "<script>alert('Iruzkina ez da ondo eguneratu datu-basean'); history.go(-1);</script>";
						} else {
							echo "<script>alert('Iruzkina ondo eguneratu da datu-basean');</script>";
						}
					}
				}
			}
            ?>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>