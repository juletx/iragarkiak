<?php include '../php/SecurityLoggedOut.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/VerifyPassAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="form">
			<form id="erregistratu" name="erregistratu" action="#" method="post">
				<fieldset>
					<legend>
						<h2>Anuntzioa gehitu</h2>
					</legend>
					<label for="category">Kategoria:</label>
					<select name="category">
                        <option value="automobilak">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                        <option value="saab">Saab</option>
                        <option value="fiat">Fiat</option>
                        <option value="audi">Audi</option>
                    </select>
					<br><br>
                    <label for="title">Titulua:</label>
					<input type="text" id="title" name="title" required>
					<br><br>
					<label for="text">Textua:</label>
					<textarea name="Text1" cols="40" rows="5" required></textarea>
					<br><br>
                    <label for="price">Prezioa:</label>
					<input type="text" id="text" name="text" required>
					<br><br>
					<label for="city">Hiria:</label>
					<input type="text" id="city" name="city" required>
					<br><br>
					<label for="city">Select Images:</label>
					Select images: 
                    <input type="file" name="img" multiple>
                    <br><br>
                    <input type="submit" id="submit" value="Sortu">
					<input type="reset" value="Berrezarri">
				</fieldset>
			</form>

			<?php
			if (isset($_POST["email"])) {
				$email = trim($_POST["email"]);
				$password1 = trim($_POST["password1"]);
				$password2 = trim($_POST["password2"]);
				$name = trim($_POST["name"]);
				$surname1 = trim($_POST["surname1"]);
				$surname2 = trim($_POST["surname2"]);
				$telephone = trim($_POST["telephone"]);

				if (empty($email) || empty($password1) || empty($password2) || empty($name) || empty($surname1) || empty($surname2) || empty($telephone)) {
					echo "<script>alert('Bete eremu guztiak'); history.go(-1);</script>";
				}
				else if (!preg_match('/[^@\s]+@[^@\s]+\.[^@\s]+/', $email)) {
					echo "<script>alert('Eposta ez da zuzena'); history.go(-1);</script>";
				}
				else if (strlen($password1) < 6 || $password1 != $password2) {
					echo "<script>alert('Pasahitzek ez dute 6ko luzera edo ez dira berdinak'); history.go(-1);</script>";
				}
				else if (!preg_match('/[0-9]{9}/', $telephone)) {
					echo "<script>alert('Telefonoak 9 digitu izan behar ditu'); history.go(-1);</script>";
				}
				else {
					include '../php/DbConfig.php';
					$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
					
					$sql = "SELECT * FROM users WHERE email='$email'";
					$emaitza = mysqli_query($esteka, $sql);

					if (!$emaitza) {
						echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
						die();
					} else if (mysqli_num_rows($emaitza) > 0) {
						echo "<script>alert('Eposta horrekin jadanik erabiltzaile bat dago'); history.go(-1);</script>";
						die();
					}
					
					mysqli_free_result($emaitza);
					
					$password_hash = password_hash($password1, PASSWORD_DEFAULT);

					$sql = "INSERT INTO users VALUES ('$email', '$password_hash', '$name', '$surname1', '$surname2', '$telephone', 0)";
					$emaitza = mysqli_query($esteka, $sql);
		
					mysqli_close($esteka);
			
					if (!$emaitza) {
						echo "<script>alert('Erabiltzailea ez da ondo gorde datu-basean'); history.go(-1);</script>";
					} else {
						echo "<script>alert('Erabiltzailea ondo gorde da datu-basean'); window.location.href = '../php/LogInIragarkiak.php'</script>".PHP_EOL;
					}
				}
			}
            ?>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>