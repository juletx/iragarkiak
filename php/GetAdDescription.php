<?php
	include '../php/DbConfig.php';
	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
	$ad_id = trim($_GET["ad_id"]);
	if (empty($ad_id)) {
		echo "<script>alert('Id-rik ez dago'); history.go(-1);</script>";
		exit();
	}
	$sql = "SELECT * FROM ads NATURAL JOIN users WHERE ad_id=$ad_id";
	$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");
	$lerroKopurua = mysqli_num_rows($result);
	if ($lerroKopurua == 0) {
		echo "<script>alert('Id okerra'); history.go(-1);</script>";
	} else {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo $row['text'];
	}
?>



