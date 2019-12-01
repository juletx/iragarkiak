<?php
$email = trim($_GET["email"]);
if (empty($email)) {
	echo "<script>alert('Epostarik ez dago'); history.go(-1);</script>";
}
include '../php/DbConfig.php';
$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

$sql = "DELETE FROM users WHERE email='$email'";
$result = mysqli_query($link, $sql);

if (!$result) {
	echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
	die();
}
else {
	$avatar = glob("../images/users/".$email.".*")[0];
	unlink($avatar);
}

mysqli_close($link);
?>