<?php include '../php/SecurityLoggedOut.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
    <!--<script src="../js/VerifyPassAjax.js"></script>-->
    <<script src="../js/ShowImageInForm.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="form">
			<form id="erregistratu" name="erregistratu" method="post" enctype='multipart/form-data'>
				<fieldset>
					<legend>
						<h2>Erregistratu</h2>
					</legend>
					<input type="email" id="email" name="email" placeholder="Posta Elektronikoa" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
					<br>
					<input type="password" id="password1" name="password1" placeholder="Pasahitza" minlength="6" required>
					<span id="baliozkoa"></span>
					<br>
					<input type="password" id="password2" name="password2" placeholder="Errepikatu pasahitza" required>
					<br>
					<input type="text" id="name" name="name" placeholder="Izena" required>
					<br>
					<input type="text" id="surname1" name="surname1" placeholder="Lehen abizena" required>
					<br>
					<input type="text" id="surname2" name="surname2" placeholder="Bigarren abizena "required>
					<br>
					<input type="tel" id="telephone" name="telephone" placeholder="Telefonoa" pattern="[0-9]{9}"
						title="Telefonoak 9 digitu izan behar ditu" required>
					<br>
                    <label for="image">Argazkia aukeratu:</label>
					<br>
					<img id="argazki" alt="Aukeratu argazkia" class="image" src="#" />
					<br>
					<input type="file" id="image" name="image" accept="image/*">
					<br>
                    <input type="submit" id="submit" value="Erregistratu">
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
                    
                    $directory = '../images/users/';
                
					if ($_FILES['image']['size'] != 0) {
						$image = $_FILES["image"]["name"];
						$tmp = explode(".", $image);
						$extension = end($tmp);
						$newFilePath = $directory.$email.".".$extension;
					
						if (!file_exists($image)) {
							move_uploaded_file($_FILES['image']['tmp_name'], $newFilePath);
						}
					}

					$password_hash = password_hash($password1, PASSWORD_DEFAULT);

					$sql = "INSERT INTO users VALUES ('$email', '$password_hash', '$name', '$surname1', '$surname2', '$telephone', 0)";
					$emaitza = mysqli_query($esteka, $sql);
		
					mysqli_close($esteka);
			
					if (!$emaitza) {
						echo "<script>alert('Erabiltzailea ez da ondo gorde datu-basean'); history.go(-1);</script>";
					} else {
						echo "<script>alert('Erabiltzailea ondo gorde da datu-basean'); window.location.href = '../php/LogIn.php'</script>".PHP_EOL;
					}
				}
			}
            ?>
		</div>
	</section>
</body>

</html>