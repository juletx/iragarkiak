<?php
session_start();
if (!isset($_SESSION['email']) || empty($_SESSION['email']) || $_SESSION['email'] == "admin@ehu.es") {
    echo "<script>alert('Ikasle eta irakasleak bakarrik sar daitezke hemen.'); window.location.href = '../php/Layout.php';</script>";
    exit();
}
?>