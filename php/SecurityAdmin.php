<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email']) || $_SESSION["email"] != "admin@ehu.es") {
	echo "<script>alert('Administratzailea bakarrik sar daiteke hemen.'); window.location.href = '../php/Layout.php';</script>";
	exit();
}
?> 