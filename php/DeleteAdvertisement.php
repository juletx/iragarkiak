<?php include '../php/SecurityLoggedIn.php' ?>
<?php
$ad_id = trim($_GET["ad_id"]);
if (empty($ad_id)) {
	echo "<script>alert('Id-rik ez dago'); history.go(-1);</script>";
	exit();
}

include '../php/DbConfig.php';
$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

$sql = "DELETE FROM ads WHERE ad_id='$ad_id'";
$result = mysqli_query($link, $sql);

if (!$result) {
	echo "<script>alert('Errorea datu-basearen kontsultan'); history.go(-1);</script>";
	die();
}
else {
	$directory = '../images/ads/'.$ad_id.'/';
	array_map('unlink', glob("$directory*.*"));
	rmdir($directory);
	echo "<script>alert('Iragarkia ongi ezabatu da'); history.go(-1);</script>";
}

mysqli_close($link);
?>
