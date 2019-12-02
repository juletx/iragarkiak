<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
	<a class="navbar-brand" href="Layout.php">
		<img src="../images/logo.png">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup1"
		aria-controls="navbarNavAltMarkup1" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup1">
		<div class="navbar-nav mr-auto">
			<a class="nav-item nav-link" href="Layout.php">Hasiera</a>
			<a class="nav-item nav-link" href="Credits.php">Kredituak</a></span>
			<a class="nav-item nav-link" href="https://gitlab.com/juletx/Iragarkiak" target="_blank">GitLab</a>

			<?php if (empty($_SESSION["email"])) { ?>

		</div>
		<div class="navbar-nav ml-auto">
			<a class="nav-item nav-link" href="SignUp.php">Erregistratu</a>
			<a class="nav-item nav-link" href="LogIn.php">Login</a>
		</div>

			<?php } else { 
			include '../php/DbConfig.php';
			$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

			$email = $_SESSION['email'];

			$sql = "SELECT admin FROM users WHERE email='$email'";
			$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			mysqli_close($link);
		
			if ($row['admin']) { 
			?>
			<a class="nav-item nav-link" href="HandlingAccounts.php">Erabiltzaileak kudeatu</a>

			<?php } else { ?>

			<a class="nav-item nav-link" href="AddAdvertisement.php">Iragarkia gehitu</a>
			<a class="nav-item nav-link" href="ShowAdvertisementsUser.php?email=<?php echo $email ?>">Nire
				iragarkiak</a>
		
			<?php } ?>
		
		</div>
		<div class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					<?php echo $email ?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="ManageAccount.php">Profila</a>
					<a class="dropdown-item"
						onclick="if (confirm('Ziur al zaude?')) location.href='LogOut.php'">Logout</a>
				</div>
			</li>
		</div>
			<?php } ?>
	</div>
</nav>