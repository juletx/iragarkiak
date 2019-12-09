<?php include '../php/SecurityLoggedIn.php' ?>
<?php
	$email = $_SESSION["email"];
	$password1 = trim($_POST["password1"]);
	$password2 = trim($_POST["password2"]);
	$name = trim($_POST["name"]);
	$surname1 = trim($_POST["surname1"]);
	$surname2 = trim($_POST["surname2"]);
	$telephone = trim($_POST["telephone"]);

	if (empty($password1) || empty($password2) || empty($name) || empty($surname1) || empty($surname2) || empty($telephone)) {
		echo "<script>alert('Bete eremu guztiak');</script>";
	}
	else if (strlen($password1) < 6 || $password1 != $password2) {
		echo "<script>alert('Pasahitzek ez dute 6ko luzera edo ez dira berdinak');</script>";
	}
	else if (!preg_match('/[0-9]{9}/', $telephone)) {
		echo "<script>alert('Telefonoak 9 digitu izan behar ditu');</script>";
	}
	else {
		include '../php/DbConfig.php';
		$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
		
		$sql = "SELECT * FROM users WHERE email='$email'";
		$emaitza = mysqli_query($esteka, $sql);

		if (!$emaitza) {
			echo "<script>alert('Errorea datu basearen kontsultan');</script>";
			die();
		} else if (mysqli_num_rows($emaitza) == 0) {
			echo "<script>alert('Eposta horrekin ez dago erabiltzailerik');</script>";
			die();
		}

		mysqli_free_result($emaitza);

		$sql = "UPDATE users SET name='$name', surname1='$surname1', surname2='$surname2', telephone='$telephone' WHERE email='$email'";
		$emaitza = mysqli_query($esteka, $sql);

		// pasahitza aldatu bada datu basean eguneratu
		if($password1 != 123456) {
			$password_hash = password_hash($password1, PASSWORD_DEFAULT);
			$sql = "UPDATE users SET password='$password_hash' WHERE email='$email'"; 
			$emaitza = mysqli_query($esteka, $sql);
		}    

		// irudia eguneratu
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

		mysqli_close($esteka);			
		if (!$emaitza) {
			echo "Erabiltzailea ez da ondo eguneratu datu-basean";
		} else {
			echo "Erabiltzailea ondo eguneratu da datu-basean".PHP_EOL;
		}
	}
?>