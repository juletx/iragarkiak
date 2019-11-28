<?php include '../php/SecurityLoggedOut.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<section class="main" id="s1">
		<div id="form">
			<form id="login" name="login" action="#" method="post">
				<fieldset>
					<legend>
						<h2>Login</h2>
					</legend>
					<label for="email">Eposta(*):</label>
					<input type="email" id="email" name="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
					<br><br>
					<label for="password">Pasahitza(*):</label>
					<input type="password" id="password" name="password" required>
					<br><br>
					<input type="submit" value="Login">
					<input type="reset" value="Berrezarri">
				</fieldset>
			</form>

			<?php
			if (isset($_POST["email"])) {
				include '../php/DbConfig.php';
				$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

				$email = $_POST['email'];
				$password = $_POST['password'];
			
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
							$password_hash = $row['password'];
							if (!password_verify($password, $password_hash)) {
								echo "<script>alert('Erabiltzaile edo pasahitz okerra'); history.go(-1);</script>";
							} else {
								$_SESSION["email"] = $email;
								echo "<script>alert('Ongi etorri ".$email."');</script>";
								if ($email == "admin@ehu.es") {
									echo "<script>window.location.href = '../php/HandlingAccounts.php'</script>";
								}
								echo "<script>window.location.href = '../php/Layout.php'</script>";
							}
						}
					}
				}

				mysqli_free_result($emaitza);
				mysqli_close($esteka);
			}
            ?>
		</div>
	</section>
	<?php include '../html/Footer.html' ?>
</body>

</html>