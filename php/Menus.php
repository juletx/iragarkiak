<header class='navbar fixed-top'>
	<img class="navbar-brand" src="../images/logo.png">
	<button type="button" onclick="location.href='Layout.php'" class="btn btn-primary btn-lg">Hasiera</button>
	
<?php if (empty($_SESSION["email"])) { ?>

	<button type="button" onclick="location.href='LogIn.php'" class="btn btn-primary btn-lg">Login</button>
	<button type="button" onclick="location.href='SignUp.php'" class="btn btn-primary btn-lg">Erregistratu</button>

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
	<button type="button" onclick="location.href='HandlingAccounts.php'" class="btn btn-primary btn-lg">Erabiltzaileak kudeatu</button>
	<button type="button" onclick="location.href='ManageAccount.php'" class="btn btn-primary btn-lg"><?php echo $email ?></button>
	<button type="button" onclick="if (confirm('Ziur al zaude?')) location.href='LogOut.php'" class="btn btn-primary btn-lg"><?php echo $email ?></button>

<?php } else { ?>
    <button type="button" onclick="location.href='AddAdvertisement.php'" class="btn btn-primary btn-lg">Iragarkia gehitu</button>
    <button type="button" onclick="location.href='ShowAdvertisementsUser.php?email=<?php echo $email ?>'" class="btn btn-primary btn-lg">Nire iragarkiak</button>
    <button type="button" onclick="if (confirm('Ziur al zaude?')) location.href='LogOut.php'" class="btn btn-primary btn-lg">Logout</button>
    <button type="button" onclick="location.href='ManageAccount.php'" class="btn btn-light btn-lg"><?php echo $email ?></button>
	
<?php } } ?>

</header>