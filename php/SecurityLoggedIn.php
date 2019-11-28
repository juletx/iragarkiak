<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    echo "<script>alert('Erabiltzaile kautotuak bakarrik sar daitezke hemen.'); window.location.href = '../php/Layout.php';</script>";
    exit();
}
?>