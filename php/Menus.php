<header class='navbar'>
	<img src="../images/logo.png">
    <button type="button" onclick="location.href='Layout.php'" class="btn btn-primary btn-lg">Hasiera</button>
<?php if (empty($_SESSION["email"])) { ?>

	<span><a href="LogIn.php" class="buttonIrekiSesioa">Login</a></span>
	<span><a href="SignUp.php">Erregistratu</a></span>

<?php } else { 
    $email = $_SESSION["email"]; ?>
    <?php if ($email == "admin@ehu.es") { ?>
    <span><a href="HandlingAccounts.php">Erabiltzaileak kudeatu</a></span>
	<span><a href="ManageAccount.php"><?php echo $email ?></a></span>
	<span><a href="LogOut.php">Logout</a></span>
<?php } else { ?>
    <button type="button" onclick="location.href='AddAdvertisement.php'" class="btn btn-primary btn-lg">Iragarkia gehitu</button>
    <button type="button" onclick="location.href='ShowAdvertisementsUser.php?email=<?php echo $email ?>'" class="btn btn-primary btn-lg">Nire iragarkiak</button>
    <button type="button" onclick="location.href='LogOut.php'" class="btn btn-primary btn-lg">Logout</button>
    <button type="button" onclick="location.href='ManageAccount.php'" class="btn btn-light btn-lg"><?php echo $email ?></button>
	
<?php } } ?>

	
</header>