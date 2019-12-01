<header class='navbar'>
	<img src="../images/logo.png">

<?php if (empty($_SESSION["email"])) { ?>

	<span><a href="LogIn.php" class="buttonIrekiSesioa">Login</a></span>
	<span><a href="SignUp.php">Erregistratu</a></span>

<?php } else { 
	include '../php/DbConfig.php';
	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

	$email = $_SESSION['email'];

	$sql = "SELECT admin FROM users WHERE email='$email'";
	$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	mysqli_close($link);
?>
	<span><a href="ShowAccount.php"><?php echo $email ?></a></span>
	<span><a href="LogOut.php">Logout</a></span>
	
<?php if ($row['admin']) { ?>

	<span><a href="HandlingAccounts.php">Erabiltzaileak kudeatu</a></span>
	
<?php } else { ?>

	<span><a href="AddAdvertisement.php" class="buttonProduktuaIgo">Iragarkia gehitu</a></span>
	<span><a href="ShowAdvertisementsUser.php?email=<?php echo $email ?>">Nire iragarkiak</a></span>

<?php } } ?>

	<span><a href="Layout.php">Hasiera</a></span>
</header>