<header class='navbar'>
	<img src="../images/logo.png">

<?php if (empty($_SESSION["email"])) { ?>

	<span><a href="LogIn.php" class="buttonIrekiSesioa">Login</a></span>
	<span><a href="SignUp.php">Erregistratu</a></span>

<?php } else { $email = $_SESSION["email"]; ?>

	<span><a href="ShowAccount.php"><?php echo $email ?></a></span>
	<span><a href="LogOut.php">Logout</a></span>
	
<?php if ($email == "admin@ehu.es") { ?>

	<span><a href="HandlingAccounts.php">Erabiltzaileak kudeatu</a></span>
	
<?php } else { ?>

	<span><a href="AddAdvertisement.php" class="buttonProduktuaIgo">Iragarkia gehitu</a></span>
	<span><a href="ShowAdvertisements.php">Nire iragarkiak</a></span>

<?php } } ?>

	<span><a href="Layout.php">Hasiera</a></span>
</header>