<?php include '../php/SecurityUsers.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html' ?>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<div class="main">
		<div class="home">
			<?php
            include '../php/DbConfig.php';
			$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");

			function get_sql() {			
				$filters = array();
			
				if (isset($_GET['category']) && !empty($category = trim($_GET['category']))) {
					$filters[] = "category='$category'";
				}
				if (isset($_GET['text']) && !empty($text = trim($_GET['text']))) {
					$filters[] = "title LIKE '%$text%' OR text LIKE '%$text%'";
				}
				if (isset($_GET['city']) && !empty($city = trim($_GET['city']))) {
					$filters[] = "city='$city'";
				}
				if (isset($_GET['min_price']) && !empty($min_price = trim($_GET['min_price']))) {
					$filters[] = "price>='$min_price'";
				}
				if (isset($_GET['min_price']) && !empty($max_price = trim($_GET['max_price']))) {
					$filters[] = "price<='$max_price'";
				}
			
				$sql = "SELECT * FROM ads NATURAL JOIN users";
				if (count($filters) > 0) {
					$sql .= " WHERE " . implode(' AND ', $filters);
				}
			
				return $sql;
			}
            
            $sql = get_sql();
			$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");

			while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
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
									<div class="home-anuntzio-detail-deskripzio">'
										.$row['text'].
									'</div>
								</div>
								<div class="home-anuntzio-detail-irudi">
									<img class="home-anuntzio-detail-irudi-txiki" src="'.$row['images'].'quiz.png">
								</div>
							</div>
							<p class="prezioa">'.$row['price'].'€</p><br><br><br>
							<div class="home-anuntzio-footer">
								<a href="#" class="home-anuntzio-footer-kontaktua">&#9743;'.$row['telephone'].'</a>
								<a href="#" class="home-anuntzio-footer-kontaktua">&#9993;'.$row['email'].'</a>
							</div>
							<div>
								<span><a href="">Iragarkia editatu</a></span>
								<span><a href="DeleteAdvertisement.php?ad_id='.$row['ad_id'].'">Iragarkia ezabatu</a></span>
							</div>
						</div>';					
			}

			mysqli_free_result($emaitza);
            mysqli_close($esteka);
			?>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>