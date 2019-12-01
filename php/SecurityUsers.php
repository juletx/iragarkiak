<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
	echo "<script>alert('Erabiltzaile arruntak bakarrik sar daiteke hemen.'); window.location.href = '../php/Layout.php';</script>";
	exit();
}
else {
	include '../php/DbConfig.php';
	$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

	$email = $_SESSION['email'];

	$sql = "SELECT admin FROM users WHERE email='$email'";
	$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if ($row['admin']) {
		echo "<script>alert('Erabiltzaile arruntak bakarrik sar daiteke hemen.'); window.location.href = '../php/Layout.php';</script>";
		exit();
	}

	mysqli_close($link);
}
?>