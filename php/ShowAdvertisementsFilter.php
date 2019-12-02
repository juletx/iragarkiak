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
echo "<div>Aurkitutako iragarki kopurua: ".$row['COUNT(*)']."<div>";

$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");
$id = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo 	'<div class="home-anuntzio">
				<div class="home-anuntzio-head"></div>
				<div class="home-anuntzio-detail">
					<div class="home-anuntzio-detail-textu">
						<a href="Ad.php?ad_id='.$row['ad_id'].'"><b>'.$row['title'].'</b></a><br>
                        <a href="Layout.php?category='.$row['category'].'">
                        <i class="fa fa-list-alt" aria-hidden="true">'.$row['category'].'</i><a>
						<div class="home-anuntzio-detail-textu-tokiordu">
                        <a href="Layout.php?city='.$row['city'].'">
                        <span class="home-anuntzio-detail-textu-toki"><i class="fa fa-map-marker"
								style="font-size:24px">'.$row['city'].'</i></span></a>
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
					<div id="carousel-thumb'.$id.'" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">';
                        $images = glob($directory."*.*");
                        $i = 0;
                        foreach ($images as $image) {
                            if ($i == 0) {
                                echo	'<div class="carousel-item active">
                                			<img class="d-block w-100" src="'.$image.'" alt="First slide">
                            			</div>'; 
                            }else {
                                echo	'<div class="carousel-item">
                                			<img class="d-block w-100" src="'.$image.'" alt="Next slides">
                            			</div>';
                            }
                            $i++;     
                        }
                        echo'</div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-thumb'.$id.'" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-thumb'.$id.'" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                        </div>
				</div>
				<p class="prezioa">'.$row['price'].'€</p><br><br><br>
				<div class="home-anuntzio-footer">
					<a href="#" class="home-anuntzio-footer-kontaktua">&#9743;'.$row['telephone'].'</a>
					<a href="#" class="home-anuntzio-footer-kontaktua">&#9993;'.$row['email'].'</a>
				</div>';
				if (isset($_SESSION['email'])) {
					$email_db = $row['email'];
					$email_session = $_SESSION['email'];

					$sql = "SELECT admin FROM users WHERE email='$email_session'";
					$result2 = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

					$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

					if ($row2['admin'] || $email_session == $email && $email_session == $email_db) {
						echo 	'<div>
									<span><a href="EditAdvertisement.php?ad_id='.$row['ad_id'].'">Iragarkia editatu</a></span>
									<span><a onclick="'; echo 'if (confirm(\'Ziur al zaude?\')) location.href=\'DeleteAdvertisement.php?ad_id='.$row['ad_id'].'\'">Iragarkia ezabatu</a></span>
								</div>';
					}
				}
				
			echo '</div>';					
            $id = $id + 1;
        }

mysqli_free_result($result);
mysqli_close($link);
?>