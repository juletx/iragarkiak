<?php
$local = 1; //0 for cloud database
if ($local) {
    $zerbitzaria = "localhost";
    $erabiltzailea = "root";
    $gakoa = "admin";
    $db = "db";
} else {
    $zerbitzaria = "localhost";
    $erabiltzailea = "id11745620_iragarkiak";
    $gakoa = "********";
    $db = "id11745620_advertisements";
}
?>