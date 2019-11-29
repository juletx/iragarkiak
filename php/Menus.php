<header class='navbar'>
	<img src="../images/logo.png">

<?php if (empty($_SESSION["email"])) { ?>

	<span><a href="LogIn.php" class="buttonIrekiSesioa">Login</a></span>
	<span><a href="SignUp.php">Erregistratu</a></span>

<?php } else { $email = $_SESSION["email"]; ?>

	<span><a href=""><?php echo $email ?></a></span>
	<span><a href="LogOut.php">Logout</a></span>
	
<?php if ($email == "admin@ehu.es") { ?>

	<span><a href="HandlingAccounts.php">Erabiltzaileak kudeatu</a></span>
	
<?php } else { ?>

	<span><a href="">Iragarkia ezabatu</a></span>
	<span><a href="../php/AddAdvertisement.php" class="buttonProduktuaIgo">Iragarkia gehitu</a></span>
	<span><a href="">Iragarkiak ikusi</a></span>

<?php } } ?>

	<span><a href="Layout.php">Hasiera</a></span>
</header>