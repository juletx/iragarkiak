<?php
include '../php/DbConfig.php';
$link = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

// filtroak gordetzen dituen array-a
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

// filtro guztiak sql kontsultara gehitu
if (count($filters) > 0) {
	$sql .= " WHERE " . implode(' AND ', $filters);					
	$sql_count .= " WHERE " . implode(' AND ', $filters);
}

// emaitzaren ordena zehaztu
if (isset($_GET['order']) && !empty($order = trim($_GET['order']))) {
	$sql .= " ORDER BY ";
	switch ($order) {
	case "Berrienak":
		$sql .= "date DESC";
		break;
	case "Zaharrenak":
		$sql .= "date";
		break;
	case "Merkeenak":
		$sql .= "price";
		break;
	case "Garestienak":
		$sql .= "price DESC";
		break;
	}
} else {
	$sql .= " ORDER BY date DESC";
}

// aurkitutako iragarki kopurua
$result_count = mysqli_query($link, $sql_count) or die("Errorea datu-baseko kontsultan");
$row = mysqli_fetch_array($result_count, MYSQLI_ASSOC);
echo "<div><h4>Aurkitutako iragarki kopurua: ".$row['COUNT(*)']."</h4></div>";

$result = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");

// datu-baseko tupla bakoitzeko iragarkia inprimatu
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo '
			<div class="home-anuntzio" id="home-anuntzio'.$row['ad_id'].'">
				<div class="home-anuntzio-head"></div>
				<div class="home-anuntzio-detail">
					<div class="home-anuntzio-detail-textu">
						<h4><a href="Ad.php?ad_id='.$row['ad_id'].'"><b>'.$row['title'].'</b></a></h4><br>
						<a href="Layout.php?category='.$row['category'].'">
						<i class="fa fa-list-alt" aria-hidden="true">'.$row['category'].'</i><a>
						<div class="home-anuntzio-detail-textu-tokiordu">
						<a href="Layout.php?city='.$row['city'].'">
						<span class="home-anuntzio-detail-textu-toki"><i class="fa fa-map-marker"
								style="font-size:24px">'.$row['city'].'</i></span></a>
							<span class="home-anuntzio-detail-textu-denbora"><i class="fa fa-clock-o"
								aria-hidden="true" style="font-size:24px">'.$row['date'].'</i></span>
						</div>
						<div class="home-anuntzio-detail-deskripzio" id="home-anuntzio'.$row['ad_id'].'-deskripzio">';
							echo substr($row['text'] , 0, 400);
							if(strlen($row['text'])>400){
							echo '<a href=\'javascript:;\' onclick=\'GetFullDescription('. $row['ad_id'] .');\'> ... Gehiago erakutsi[+] </a>';
							}
							//Aukeratu anuntzioari dagokion irudien karpetatik lehenengo irudiaren izena
							$directory = "../images/ads/".$row['ad_id']."/";
							$files = scandir ($directory);
							$firstFile = $directory . $files[2];
						echo '</div>
					</div>
					<div class="home-anuntzio-detail-irudi" id="gallery" data-toggle="modal" data-target="#imageModal'.$row['ad_id'].'">
						<img class="home-anuntzio-detail-irudi-txiki" src="'. $firstFile .'" alt="Lehen irudia" data-target="#imageCarousel'.$row['ad_id'].'" data-slide-to="0">
					</div>
				</div>
				<p class="prezioa">'.$row['price'].'€</p><br><br><br>
				<div class="home-anuntzio-footer">
                    <h4><span class="badge badge-pill badge-info">&#9743;'.$row['telephone'].'</span></h4>    
                    <h4><span class="badge badge-pill badge-info">&#9993;'.$row['email'].'</span></h4> 
				</div>';
				// Iragarkiaren egileari edo adminari editatzeko eta borratzeko aukera
				if (isset($_SESSION['email'])) {
					$email_db = $row['email'];
					$email_session = $_SESSION['email'];
	
					$sql = "SELECT admin FROM users WHERE email='$email_session'";
					$result2 = mysqli_query($link, $sql) or die("Errorea datu-baseko kontsultan");
	
					$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
	
					if ($row2['admin'] || $email_session == $email && $email_session == $email_db) {
						echo 	'<br><div>
									<span><a class="btn btn-success" href="EditAdvertisement.php?ad_id='.$row['ad_id'].'">Iragarkia editatu</a></span>
									<span><a class="btn btn-danger" onclick="'; echo 'if (confirm(\'Ziur al zaude?\')) location.href=\'DeleteAdvertisement.php?ad_id='.$row['ad_id'].'\'">Iragarkia ezabatu</a></span>
								</div>';
					}
				}
			
			// argazkien bistaratzea bootstrapen modal eta carousel erabiliz
			echo '</div>
			<div class="modal fade" id="imageModal'.$row['ad_id'].'" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>';

						$images = glob($directory."*.*");
						$imagecount = count($images);
						echo
						'<div class="modal-body">
							<div id="imageCarrousel'.$row['ad_id'].'" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">';
							$i=0;
							while($i<$imagecount){
								if ($i == 0){
									echo '<li data-target="#imageCarousel'.$row['ad_id'].'" data-slide-to="0" class="active"></li>';
								}else {
									echo '<li data-target="#imageCarousel'.$row['ad_id'].'" data-slide-to="'.$i.'"></li>';
								}
								$i++;
							}

							echo '</ol>
							<div class="carousel-inner">';

							//Modal-aren kodea, bootstrap erabiliz
						
							$images = glob($directory."*.*");
							$i = 0;
							foreach ($images as $image) {
								if ($i == 0) {
									echo' <div class="carousel-item active">
									<img class="d-block w-100" src="'.$image.'" alt="1. irudia" data-slide-to="0">
									</div>';
								}else {
									echo	'<div class="carousel-item">
										<img class="d-block w-100" src="'.$image.'" alt="'.$i.'. irudia" data-slide-to="'.$i.'">
									</div>';
								}
								$i++;     
							}
						echo'
								</div>
								<a class="carousel-control-prev" href="#imageCarrousel'.$row['ad_id'].'" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#imageCarrousel'.$row['ad_id'].'" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>';
}

mysqli_free_result($result);
mysqli_close($link);
?>