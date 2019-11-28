<?php
$email = trim($_GET["email"]);
if (empty($email)) {
	echo "<script>alert('emailrik ez dago'); history.go(-1);</script>";
}

include '../php/DbConfig.php';
$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

$sql = "SELECT banned FROM users WHERE email='$email'";
$emaitza = mysqli_query($esteka, $sql);

if (!$emaitza) {
	echo "<script>alert('Errorea datu basearen kontsultan'); history.go(-1);</script>";
	die();
} else {
	$row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC);
	$banned = $row['banned'];
}

mysqli_free_result($emaitza);

if ($banned) {
	$banned = 0;
	$erantzuna = "Aktibatuta";
} else {
	$banned = 1;
	$erantzuna = "Baneatuta";
}
	
echo $erantzuna;

$sql = "UPDATE users SET banned='$banned' WHERE email='$email'";
$emaitza = mysqli_query($esteka, $sql);

mysqli_close($esteka);
?>