<header class='navbar'>
	<img src="../images/logo.png">

<?php if (empty($_SESSION["email"])) { ?>

	<span><a href="LogIn.php" class="buttonIrekiSesioa">Login</a></span>
	<span><a href="SignUp.php">Erregistratu</a></span>

<?php } else { $email = $_SESSION["email"]; ?>

	<span style="color:blue;"><?php echo $email ?></span>
	<span><a href="LogOut.php">Logout</a></span>
	
<?php if ($email == "admin@ehu.es") { ?>

	<span><a href="HandlingAccounts.php">Erabiltzaileak kudeatu</a></span>
	
<?php } else { ?>

	<span><a href="">Produktua ezabatu</a></span>
	<span><a href="" class="buttonProduktuaIgo">Produktua igo</a></span>
	<span><a href="">Produktuak ikusi</a></span>

<?php } } ?>

	<span><a href="Layout.php">Hasiera</a></span>
</header>