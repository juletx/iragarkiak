<?php
include '../php/DbConfig.php';
$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

$filters = array();

if (isset($_GET['email']) && !empty($email = trim($_GET['email']))) {
	$filters[] = "email='$email'";
}
if (isset($_GET['category']) && !empty($category = trim($_GET['category']))) {
	$filters[] = "category='$category'";
}
if (isset($_GET['text']) && !empty($text = trim($_GET['text']))) {
	$words = explode(" ", $text);
	foreach ($words as $word) {
		$filters[] = "(title LIKE '%$word%' OR text LIKE '%$word%')";
	}
}
if (isset($_GET['city']) && !empty($city = trim($_GET['city']))) {
	$filters[] = "city='$city'";
}
if (isset($_GET['min_price']) && !empty($min_price = trim($_GET['min_price']))) {
	$filters[] = "price>='$min_price'";
}
if (isset($_GET['max_price']) && !empty($max_price = trim($_GET['max_price']))) {
	$filters[] = "price<='$max_price'";
}

$sql = "SELECT * FROM ads NATURAL JOIN users";
$sql_count = "SELECT COUNT(*) FROM ads NATURAL JOIN users";

if (count($filters) > 0) {
	$sql .= " WHERE " . implode(' AND ', $filters);					
	$sql_count .= " WHERE " . implode(' AND ', $filters);
}

if (isset($_GET['order']) && !empty($order = trim($_GET['order']))) {
	$sql .= " ORDER BY ";
	switch ($order) {
	case "Berrienak":
		$sql .= "date";
		break;
	case "Zaharrenak":
		$sql .= "date DESC";
		break;
	case "Merkeenak":
		$sql .= "price";
		break;
	case "Garestienak":
		$sql .= "price DESC";
		break;
	}
}

$result_count = mysqli_query($link, $sql_count) or die("Errorea datu-baseko kontsultan");
$row = mysqli_fetch_array($result_count, MYSQLI_ASSOC);
echo $row['COUNT(*)'].' iragarki aurkitu d(ir)a'.PHP_EOL;

$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo 	'<div class="home-anuntzio">
				<div class="home-anuntzio-head"></div>
				<div class="home-anuntzio-detail">
					<div class="home-anuntzio-detail-textu">
						<a href="Ad.php?ad_id='.$row['ad_id'].'"><b>'.$row['title'].'</b></a><br>
						<i class="fa fa-list-alt" aria-hidden="true">'.$row['category'].'</i>
						<div class="home-anuntzio-detail-textu-tokiordu">
							<span class="home-anuntzio-detail-textu-toki"><i class="fa fa-map-marker"
								style="font-size:24px">'.$row['city'].'</i></span>
							<span class="home-anuntzio-detail-textu-denbora"><i class="fa fa-clock-o"
								aria-hidden="true" style="font-size:24px">'.$row['date'].'</i></span>
						</div>
						<div class="home-anuntzio-detail-deskripzio">';
							echo substr($row['text'] , 0, 400);
							if(strlen($row['text'])>400) {
								echo '<a href=\'javascript:;\' onclick=\'GetFullDescription('. $row['ad_id'] .');\'> ... Gehiago erakutsi[+] </a>';
							}
							//Aukeratu anuntzioari dagokion irudien karpetatik lehenengo irudaren izena
							$directory = "../images/ads/".$row['ad_id']."/";
							$files = scandir($directory);
							$firstFile = $directory . $files[2];// because [0] = "." [1] = ".." 
						echo '</div>
					</div>
					<div class="home-anuntzio-detail-irudi">
						<img class="home-anuntzio-detail-irudi-txiki" src="'. $firstFile .'">
					</div>
				</div>
				<p class="prezioa">'.$row['price'].'€</p><br><br><br>
				<div class="home-anuntzio-footer">
					<a href="#" class="home-anuntzio-footer-kontaktua">&#9743;'.$row['telephone'].'</a>
					<a href="#" class="home-anuntzio-footer-kontaktua">&#9993;'.$row['email'].'</a>
				</div>';
				if (isset($_SESSION['email']) && $_SESSION['email']==$email && $_SESSION['email']==$row['email']) {
					echo 	'<div>
								<span><a href="">Iragarkia editatu</a></span>
								<span><a href="DeleteAdvertisement.php?ad_id='.$row['ad_id'].'">Iragarkia ezabatu</a></span>
							</div>';
				} 
				
			echo '</div>';					
}

mysqli_free_result($result);
mysqli_close($link);
?>