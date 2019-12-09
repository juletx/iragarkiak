<?php
	if (isset($_POST["email_login"])) {
		include '../php/DbConfig.php';
		$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

		$email = $_POST['email_login'];
		$password = $_POST['password_login'];
	
		$sql = "SELECT * FROM users WHERE email='$email'";
		$emaitza = mysqli_query($esteka, $sql);

		if (!$emaitza) {
			echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
		} else {
			$lerroKopurua = mysqli_num_rows($emaitza);
			if ($lerroKopurua == 0) {
				echo "<script>alert('Erabiltzaile edo pasahitz okerra'); history.go(-1);</script>";
			} else {
				$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
				if ($row['banned']) {
					echo "<script>alert('Erabiltzailea blokeatuta dago, jarri kontaktuan adminarekin'); history.go(-1);</script>";
				} else {
					// pasahitza zuzena dela egiaztatu
					$password_hash = $row['password'];
					if (!password_verify($password, $password_hash)) {
						echo "<script>alert('Erabiltzaile edo pasahitz okerra'); history.go(-1);</script>";
					} else {
						$_SESSION["email"] = $email;
						echo "<script>alert('Ongi etorri ".$email."'); window.location.href = '../php/Layout.php';</script>";
					}
				}
			}
		}

		mysqli_free_result($emaitza);
		mysqli_close($esteka);
	}
?>

<form class="form-inline" id="login" name="login" method="post">
	<input class="form-control mr-sm-2" type="email" id="email_login" name="email_login" placeholder="Eposta"
		aria-label="Eposta" required>
	<input class="form-control mr-sm-2" type="password" id="password_login" name="password_login" placeholder="Pasahitza"
		aria-label="Pasahitza" required>
	<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button>
</form>